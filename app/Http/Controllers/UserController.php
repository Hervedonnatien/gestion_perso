<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pointage;
use Illuminate\Support\Facades\DB;
use Session;
use Datetime;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=DB::table('users')
        ->join('personnels', 'personnels.num_matricule', '=', 'users.personnel_num_matricule')
        ->get();
        return view('users.user_liste',compact('users'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $errors = array();
        return view('auth.register',compact('errors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personnel=DB::table('personnels')->where('num_matricule',$request->get('im'))->first();
        $all_im = array();
        $all_im_user = array();
        $errors = array();
        if ($request && $personnel) {
             $personnels=DB::table('personnels')->get();
             foreach ($personnels as $person) {
                array_push($all_im,$person->num_matricule);
             }
             $users=DB::table('users')->get();
             foreach ($users as $user) {
                array_push($all_im_user,$user->personnel_num_matricule);
             }
            if ($request->get('password')!=$request->get('confirm_password')) {
                array_push($errors,'Le mot de passe doit etre identiques');
            }
            if (!in_array($request->get('im'), $all_im)) {
                array_push($errors,'Numero matricule n\'existe pas');
            }
            if (in_array($request->get('im'), $all_im_user)) {
                array_push($errors,'Numero matricule appartient un compte');
            }
            if ($request->get('secret')!=$personnel->secret_identity) {
                array_push($errors,'Identification secret n\'est pas correct');
            }
            if (count($errors)==0) {
                $password_hashed = password_hash($request->get('password'), PASSWORD_DEFAULT);
                User::create([
                    "personnel_num_matricule" =>$request->get('im'),
                    "email_personnel" =>$personnel->email,
                    "password" =>$password_hashed,
                    "question1" =>$request->question1,
                    "question2" =>$request->question2
                ]);
                return redirect(route('outside_user'));
            }
        }else {
            array_push($errors,'Numéro matricule n\'est pas validé');
        }
    return view('/auth/register',compact('errors'));
    }
    public function question_check(Request $request)
    { 
        $errors = array();
             $user=DB::table('users')->where('email_personnel',$request->email)->first();
            if (!$user){
                array_push($errors,'Email inconnu');
            }else{
                $personnel=DB::table('personnels')->where('num_matricule',$user->personnel_num_matricule)->first();
                if ($request->get('question1')!=$user->question1) {
                array_push($errors,'Question numéro 1 n\'est pas correct');
                }
                if ($request->get('question2')!=$user->question2) {
                array_push($errors,'Question numéro 2 n\'est pas correct');
                }
                if (count($errors)==0) {
                    session::put('email',$personnel->email);
                    session::put('im_user',$user->personnel_num_matricule);
                    session::put('role',$user->role);
                    session::put('nom',$personnel->nom_prenom);
                    Pointage::create([
                    'heure_entre'=>date('H:i:s'),
                    'personnel_num_matricule'=>$user->personnel_num_matricule,
                ]);
                return redirect(route('outside_user'));
                }
            }
        return view('auth.forget_password',compact('errors'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Auth 
    public function login(Request $request)
    { 
        $all_im = array();
        $info ='';
         $pointages_im=DB::table('pointages')->get();
        foreach ($pointages_im as $row) {
                array_push($all_im,$row->personnel_num_matricule);
             }
        $user = DB::table('users')
            ->join('personnels','personnels.num_matricule','=','users.personnel_num_matricule')
            ->select('users.*','personnels.*')
            ->where('email',$request->get('email'))->first();
        if ($user && password_verify($request->get('password'), $user->password)) {
                session::put('email',$user->email);
                session::put('im_user',$user->personnel_num_matricule);
                session::put('role',$user->role);
                session::put('nom',$user->nom_prenom);
            if (in_array($user->personnel_num_matricule, $all_im)) {
                session::put('info','<div class="alert alert-success text-center">Vous avez pointé avant');
            }else{
                Pointage::create([
                'heure_entre'=>date('H:i:s'),
                'personnel_num_matricule'=>$user->personnel_num_matricule,
                ]);
            } 
        return redirect(route('outside_user'));
            
        }else{
            $error='<div class="badge badge-danger  text-center">Identité invalide</div>';
            return view('auth.login',compact('error'));
        }
    }
    public function logout()
    {
        $affected = DB::table('pointages')
              ->where('personnel_num_matricule',session::get('im_user'))
              ->update(['heure_sortie' => date('H:i:s')]);
        Session::forget(['email','im_user','role','nom','info']);
        return redirect(route('outside_user'));
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }
    public function update_password(Request $request)
    {
        $user=DB::table('users')->where('personnel_num_matricule',session::get('im_user'))->first();
        if ($user) {
            if (!password_verify($request->get('p0'), $user->password)) {
                $message='<div class="alert alert-danger">Ancien mot de passe est incorrect</div>';
            }else {
                if ($request->get('p1')!=$request->get('p2')) {
                $message='<div class="alert alert-danger">Le mot de passe doit etre identiques</div>';
                }else{
                     $password_hashed = password_hash($request->get('p1'), PASSWORD_DEFAULT);
                DB::table('users')
                      ->where('personnel_num_matricule',session::get('im_user'))
                      ->update(['password'=>$password_hashed]);
                    $message='<div class="alert alert-success">Votre mot de passe a modifié avec succé</div>';
                     return view('auth.logged',compact('message'));
                }
        }
        return view('users.edit_password',compact('message'));
    }
}
}
