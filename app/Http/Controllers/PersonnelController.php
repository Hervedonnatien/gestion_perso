<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;
class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sanctions_deletable=DB::table('sanctions')->whereDate('date_fin','<',date('Y-m-d'))->get();
            foreach ($sanctions_deletable as $row) {
                DB::table('sanctions')->where('id',$row->id)->delete();
            }
        $personnels=DB::table('personnels')->get();
        $users=DB::table('users')->get();
        $sanctions=DB::table('sanctions')->whereDate('date_fin','>',date('Y-m-d'))->get();      
        return view('personnels.index',compact('personnels','users','sanctions'));
    }
    public function personnels(){
        $personnels=DB::table('personnels')->get();
        return view('personnels.liste',compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $titre="Nouveau personnel";
        return view('personnels.create',compact('titre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
         $this->validate($request,[
            'num_matricule'=>'required|unique:personnels',
            'name'=>'required',
            'telephone'=>'required|unique:personnels',
            'email'=>'required|unique:personnels|email',
            'situation'=>'required',
        ]);
        // if ($request->hasfile('profile')) {
        //     $file=$request->file('profile');
        //     $extension=$file->getClientOriginalExtension();
        //     $originalFilename=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        //         $safeFilename= transliterator_transliterate('Any-Latin; Latin-ASCII;[^A-Za-z0-9_] remove; Lower()',$originalFilename);
        //         $filename= $safeFilename.'-'.uniqid().'.'.$extension;
        //     $file->move('photos/personnel',$filename);
        // }else{
            if (strtolower($request->sexe)=='feminin'){
                $filename='femme.png';
            }else{
                $filename='homme.jpg';
            }
        // }
            $code =rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999).strtolower($request->get('email'));
             Personnel::create([
                'num_matricule'=> $request->get('num_matricule'),
                'nom_prenom' => $request->get('name'),
                'telephone' => $request->get('telephone'),
                'sexe' => $request->get('sexe'),
                'email' => $request->get('email'),
                'situation_familiale' => $request->get('situation'),
                'profile' =>$filename,
                'secret_identity' =>$code
            ]);
            $personnels=DB::table('personnels')->get();
            $notify ='<div class="alert alert-success"  style="font-weight: bold;">Ajout est succée</div>';
            return view('personnels.liste',compact('personnels','notify'));
    }

public function updateImage($id,Request $request){
        if ($request->hasfile('profile')) {
            $file=$request->file('profile');
            $extension=$file->getClientOriginalExtension();
            $originalFilename=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $safeFilename= transliterator_transliterate('Any-Latin; Latin-ASCII;[^A-Za-z0-9_] remove; Lower()',$originalFilename);
            $filename= $safeFilename.'-'.uniqid().'.'.$extension;
            $file->move('photos/personnel',$filename);
            DB::table('personnels')->where('num_matricule',$id)->update(['profile'=>$filename]);
            $notify ='<div class="alert alert-success"  style="font-weight: bold;">Ajout est succée</div>';
            $warning='<span class="badge badge-success float-right"><strong>Info!</strong> cette personne a du compte.</span>';
            $personnel=DB::table('personnels')->where('num_matricule',$id)->first();
            $has_account_user=DB::table('users')->where('personnel_num_matricule',$id)->first();
            if ($has_account_user == null) {
                $warning='<span class="badge badge-warning float-right"><strong>Alert!</strong> cette personne n\'a pas du compte.</span>';
            }
        }
           return redirect()->back();
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warning='<span class="badge badge-success float-right"><strong>Info!</strong> cette personne a du compte.</span>';
        $personnel=DB::table('personnels')->where('num_matricule',$id)->first();
        $has_account_user=DB::table('users')->where('personnel_num_matricule',$id)->first();
        if ($has_account_user == null) {
            $warning='<span class="badge badge-warning float-right"><strong>Alert!</strong> cette personne n\'a pas du compte.</span>';
        }
        return view('personnels.show',compact('personnel','warning','has_account_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $personnel=DB::table('personnels')->where('num_matricule',$id)->first();
       return response()->json(['data'=>$personnel],200);
        
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

       $var = $this->validate($request,[
            'name'=>'required',
            'telephone'=>'required',
            'email'=>'required|email',
            'situation'=>'required',
        ]);
       $personnel=DB::table('personnels')->where('num_matricule',$id)->update([
            'nom_prenom'=>$request->get('name'),
            'email'=>$request->get('email'),
            'situation_familiale'=>$request->get('situation'),
            'telephone'=>$request->get('telephone'),
       ]);
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Personnel::destroy($id);
       User::where('personnel_num_matricule',$id)->delete();
       $notify ='<div class="alert alert-danger" style="font-weight: bold;">Le personnel et ce compte ont été supprimé</div>';
        $personnels=DB::table('personnels')->get();
        // return view('personnels.liste',compact('personnels','notify'));
       return redirect(route('personnels'));
    }
}
