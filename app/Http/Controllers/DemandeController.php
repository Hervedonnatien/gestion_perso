<?php

namespace App\Http\Controllers;

use App\Models\Type_demande;
use App\Models\Demande;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $demandes=DB::table('demandes')
            ->join('personnels', 'personnels.num_matricule', '=', 'demandes.personnel_num_matricule')
            ->join('type_demandes', 'type_demandes.id', '=', 'demandes.type_demande_id')
            ->select('demandes.*','type_demandes.libelle','personnels.*')
            ->where('status','refus')
            ->get();
        return view('demandes.liste_demande',compact('demandes'));
   }
   public function index2()
    {
         $demandes=DB::table('demandes')
            ->join('personnels', 'personnels.num_matricule', '=', 'demandes.personnel_num_matricule')
            ->join('type_demandes', 'type_demandes.id', '=', 'demandes.type_demande_id')
            ->select('demandes.*','type_demandes.*','personnels.*')
            ->where('status','allow')
            ->get();
        return view('demandes.liste_auto_absent',compact('demandes'));

   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=DB::table('type_demandes')->get();
        return view('demandes.create_demande',compact('types'));
    }
    public function demande_create()
    {
        $types=DB::table('type_demandes')->get();
        return view('demandes.demande',compact('types'));
    }
     public function type_create()
    {
        $types=DB::table('type_demandes')->get();
        return view('demandes.type',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $types=DB::table('type_demandes')->get();
         $this->validate($request,[
            'num_matricule'=>'required',
            'type'=>'required|numeric',
            'nbrs'=>'required|numeric',
            'motif'=>'required',
        ]);
          $message='';
          $num=Personnel::find($request->num_matricule);
        if (!$num) {    
            $message='<div class="alert alert-danger text-center">Numéro matricule inconnu</div>';
            return view('demandes.create_demande',compact('types','message'));
        }
         $derniere=DB::table('demandes')
            ->join('personnels', 'personnels.num_matricule', '=', 'demandes.personnel_num_matricule')
            ->join('type_demandes', 'type_demandes.id', '=', 'demandes.type_demande_id')
            ->select('demandes.*','type_demandes.*','personnels.*')
            ->where('status','allow')
            ->where('personnel_num_matricule',$request->num_matricule)
            ->orderBy('demandes.created_at','desc')
            ->first();
        if($derniere){
                //validite de conge si son conges est en cours
                $dateD=strtotime(date('Y-m-d'));
                $dateF=strtotime($derniere->date_fin);
                $en_cours=$dateF-$dateD;
                if ($en_cours>0) {
                    $message='<div class="alert alert-danger text-center">Ce personnel a déja fu la demande</div>';
                    return view('demandes.create_demande',compact('types','message'));
                }
            }

         if ($request->admin == 'admin') {
             Demande::create([
            'date_demande'=>date("Y-m-d"),
            'nbrs'=>$request->nbrs,
            'personnel_num_matricule'=>$request->num_matricule,
            'motif'=>$request->motif,
            'status'=>'allow',
            'type_demande_id'=>$request->type,
            'date_debut'=>$request->date_debut,
            'date_fin'=>date( 'Y-m-d' , strtotime($request->date_debut.'+'.$request->nbrs.' days')),
         ]);
             $message ='<div class="alert alert-success alert-dismissible"  style="font-weight: bold;"><button type="button" class="close" data-dismiss="alert">&times;</button>La demande est approuveé</div>';
              return view('demandes.create_demande',compact('types','message'));
            }
             else {
            $personne_already_sent_demande=DB::table('demandes')->where('personnel_num_matricule',$request->num_matricule)
                                        ->where('status','refus')
                                        ->first();
                    if ($personne_already_sent_demande) {
                        $message ='<div class="alert alert-warning alert-dismissible"  style="font-weight: bold;"><button type="button" class="close" data-dismiss="alert">&times;</button>La demande n\'est pas envoyée car vous l\'avez déja fait!</div>';
                    } else {
                        Demande::create([
                        'date_demande'=>date("Y-m-d"),
                        'nbrs'=>$request->nbrs,
                        'personnel_num_matricule'=>$request->num_matricule,
                        'type_demande_id'=>$request->type,
                        'motif'=>$request->motif,
                        'date_debut'=>$request->date_debut,
                        'date_fin'=>date( 'Y-m-d' , strtotime($request->date_debut.'+'.$request->nbrs.' days')),
                        ]);
                          $message ='<div class="alert alert-success alert-dismissible"  style="font-weight: bold;"><button type="button" class="close" data-dismiss="alert">&times;</button>Votre demande est envoyé à l\'administrateur,<br> Veuillez attendre la validation!</div>';
                    }
        
        return view('demandes.demande',compact('types','message'));
    }
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

    public function decison(Request $request, $id)
    {
        $dmd =Demande::find($id);
        $output='';
        if ($dmd) {

            if ($request->ajax()) {
            if ($request->get('all_data')=='accept') {
                    $dmd->update([
                        'status'=>'allow',
                    ]);

                    }
            if ($request->get('all_data')=='delete') {
                     Demande::destroy($id);
                    }       
         }
        }
        $e=Demande::where('status','refus')->get();
        if($e->count()>0){
            foreach ($e as $demande){
                $output='
                <tr>
                <td>'.$demande->personnel_num_matricule.'</td>
                <td>'.$demande->date_debut.'</td>
                <td>'.$demande->date_fin.'</td>
                <td>'.$demande->motif.'</td>
                <td>'.$demande->created_at.'</td>
                <td>'.$demande->created_at.'</td>
                <td>
                        <select id="act'.$demande->id.'">
                            <option value="">action</option>
                            <option value="accept">Approuver</option>
                            <option value="delete">Supprimer</option>
                        </select>
                        <input type="button" id="ok'.$demande->id.'" value="ok">
                    </form>
                    <script type="text/javascript">
                        
                        $(\'#ok'.$demande->id.'\').click(function () {
                            if (confirm(\'Confirmation !\')) {
                                var formData  = $("#act'.$demande->id.'").val();

                            $.ajaxSetup({
                                headers: {
                                    \'X-CSRF-TOKEN\': $(\'meta[name="csrf-token"]\').attr(\'content\')
                                }
                            });
                          $.ajax({
                            url:"/decision/demande/'.$demande->id.'",
                            method:"get",
                            data:{
                              all_data:formData,
                            },
                            success:function(response){
                                $("tbody").html(response.output);
                            }
                          });
                            }  
                        })
                    </script>
                </td>

                ';
            }
        }
            else {
                $output='
                <tr class="text-center" style="height: 300px;">
                  <td  colspan="7" >
                    <div style="margin-top: 120px">
                      <code>Aucun demande</code>
                    </div>
                  </td>
                 </tr>
                ';
            }
            
        return response()->json(['message' =>'operation a effectué','output'=>$output],200);
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
    public function typestore(Request $request)
    {
        $this->validate($request,[
            'libelle'=>'required',
        ]);
        Type_demande::create([
            'libelle'=> $request->get('libelle'),
        ]);
        $types = Type_demande::all();
        return view('demandes.type',compact('types'));
    }
    
}
