<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\HistoPointage;
use App\Models\Pointage;
use App\Models\Absence;
use App\Models\Sanction;
use App\Models\BilanAbsence;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;

class PointageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointages=DB::table('pointages')->get();
        return view('pointages.index',compact('pointages'));
    }
    public function createtypes()
    {
        $types=DB::table('type_sanctions')->get();
        return view('pointages.type_sanction',compact('types'));
    }


    function sanction_type_store(Request $request)
    {
            $this->validate($request,[
            'libelle'=>'required',
        ]);
        DB::table('type_sanctions')->insert([
            'libelle'=> $request->get('libelle'),
        ]);
       $types=DB::table('type_sanctions')->get();
        return view('pointages.type_sanction',compact('types'));
    }

    public function indexhisto( Request $request)
    { 
        if ($request->date !='') {
        $pointages=DB::table('histo_pointages')
            ->join('personnels','personnels.num_matricule','=','histo_pointages.im')
            ->select('personnels.*','histo_pointages.*')
            ->whereDate('histo_pointages.created_at',$request->date)
            ->get();
        // $find = "false";     
        }else{ 
        $pointages=DB::table('histo_pointages')
                ->join('personnels','personnels.num_matricule','=','histo_pointages.im')
                ->select('personnels.*','histo_pointages.*')
                ->get();
          // $find = "true"; 
        }
        $date=$request->date;
        return view('pointages.histo',compact('pointages','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bilan()
    {
         $bilans=DB::table('bilan_absences')
                ->join('personnels','personnels.num_matricule','=','bilan_absences.im')
                ->where('bilan_absences.status','non')
                ->get();
         $type_sanctions=DB::table('type_sanctions')->get();

        return view('pointages.sanction',compact('bilans','type_sanctions'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function sanction_liste()
    {
        $liste_sanctions = DB::table('sanctions')
                 ->join('personnels','personnels.num_matricule','=','sanctions.im')
                 ->get();

        return view('pointages.liste_sanction',compact('liste_sanctions'));

    }
    public function sanction(Request $request,$id)
    {
        $output='';
        $output2='';
        $bilan = DB::table('bilan_absences')->where('id',$id)->first();
        if($bilan){
            Sanction::create([
           'im'=> $bilan->im,
           'jour_manque'=> $bilan->duree,
           'nbjrs'=> $request->get('nbrs'),
           'lib'=> $request->get('sanction'),
           'date_fin'=>date( 'Y-m-d' , strtotime(date('Y-m-d').'+'.$request->get('nbrs').' days'))
        ]);
          $az= DB::table('bilan_absences')->where('id',$bilan->id)->update(['status'=>'non']);
        }
        

        $a =DB::table('bilan_absences')->where('id',$id)->update(['duree'=>0,'status'=>'oui']);
        $bilans=DB::table('bilan_absences')
                ->join('personnels','personnels.num_matricule','=','bilan_absences.im')
                ->where('bilan_absences.status','non')
                ->get();
         $type_sanctions=DB::table('type_sanctions')->get();
            if($type_sanctions->count()>0){
        $output2='<option value="">Action</option>';
                foreach ($type_sanctions as $type_sanction){
                    $output2.='<option value="'.$type_sanction->libelle.'">'.$type_sanction->libelle.'</option>';
                }
            }else {
            $output2='<option value="">Aucun sanction define</option>';
            }
        
                    if($bilans->count()>0){
            foreach ($bilans as $bil){
                $output.='
                <tr>
                <td>'.$bil->im.'</td>
                <td>'.$bil->nom_prenom.'</td>
                <td>'.$bil->duree.'</td>
                <td>
                        <select id="a'.$bil->id.'">'.$output2.'</select>
                <input type="number" id="sanction_duree'.$bil->id.'" placeholder="durée du jour de sanction" >
                        <input type="button" id="sanction'.$bil->id.'" value="Sanctionner">
                    </form>
                    <script type="text/javascript">
                        alert("eee000");
                        $("#sanction'.$bil->id.'").click(function () {
                                var type_sanc'.$bil->id.'tion  = $("#a").val();
                                var duree  = $("#sanction_duree'.$bil->id.'").val();
                                $.ajaxSetup({
                                    headers: {
                                        \'X-CSRF-TOKEN\': $(\'meta[name="csrf-token"]\').attr(\'content\')
                                    }
                                });

                            if (type_sanction !="" && duree !="" ) {
                            if (confirm("Confirmation !"")) {

                                $.ajax({
                                url:"/sanctionner/'.$bil->id.'",
                                method:"get",
                                data:{
                                  nbrs:duree,sanction:type_sanction,
                                },
                                success:function(response){
                                    $("tbody").html(response.output);
                                    }
                                    });
                                    }       
                                }
                                else{
                                    alert("Champ required");
                                }
                        })
                    </script>
                </td>

                ';
            }
            }else {
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
    public function absence(Request $request)
    {
        $date=$request->date;
        $absences=DB::table('absences')
            ->join('personnels', 'personnels.num_matricule', '=', 'absences.im')
            ->select('absences.*','personnels.*') 
            ->whereDate('absences.created_at',$request->date)
            ->get();
            
        return view('pointages.abs',compact('absences','date'));
            
    }
     public function histo_store(Request $request)
    {
        $im = array();
        $im_abs = array();
        $im_dmd = array();
        $id_persent_now = array();
        $present_now=DB::table('histo_pointages')
                    ->whereDate('created_at',date('Y-m-d'))
                    ->get();
         foreach ($present_now as $row) {
             array_push($id_persent_now, $row->im);
         }
         $absences_im=DB::table('absences')
                    ->whereDate('created_at',date('Y-m-d'))
                    ->get();
         foreach ($absences_im as $row) {
             array_push($im_abs, $row->im);
         }
        $pointages=DB::table('pointages')->get();
        foreach ($pointages as $pointage) {
            array_push($im, $pointage->personnel_num_matricule);
            $sortie = ($pointage->heure_sortie) ? $pointage->heure_sortie  : date('H:i:s') ;
            if (!in_array($pointage->personnel_num_matricule, $id_persent_now)) {
               HistoPointage::create([
                  'im'=>$pointage->personnel_num_matricule,
                  'heure_entre'=>$pointage->heure_entre,
                  'heure_sortie'=>$sortie,
              ]);
            }
            Pointage::where('personnel_num_matricule',$pointage->personnel_num_matricule)->delete();
        }
        $all_conge_en_cours=DB::table('demandes')
            ->whereDate('date_fin','>',date('H-m-s'))
            ->where('status','allow')->get();
            foreach ($all_conge_en_cours as $ro) {
             array_push($im_dmd, $ro->personnel_num_matricule);
         }

            $absences=DB::table('personnels')
            ->join('users', 'users.personnel_num_matricule', '=', 'personnels.num_matricule')
            ->select('users.*','personnels.*')
            ->whereNotIn('personnels.num_matricule',$im)
            ->whereNotIn('personnels.num_matricule',$im)
            ->get();
            foreach ($absences as $absence) {
                if (!in_array($absence->personnel_num_matricule,$im_abs)) {
                    Absence::create([
                    'im'=>$absence->personnel_num_matricule,
                ]);
                }
            }
            $all_ab= DB::table('absences')
                ->select(DB::raw(' im,count(*) as duree'))
                ->where('etat','non')
                ->groupBy('im')
                ->get();
        foreach ($all_ab as $ab) {
            $im_bilan=DB::table('bilan_absences')->where('im',$ab->im)->increment('duree');
            if (!$im_bilan) {
                 BilanAbsence::create([
                    'im'=>$ab->im,
                    'duree'=>1
                ]);
            DB::table('bilan_absences')->where('im',$ab->im)->update(['status'=>'non',]);
            }

        }
        $all_ab= DB::table('absences')->where('etat','non')->update([
            'etat'=>'oui',
        ]);

        $pointages=DB::table('pointages')->get();
        return view('pointages.index',compact('pointages')); 
    }

    public function edit_type_sanction($id){
        
    $type_sanction=DB::table('type_sanctions')->where('id',$id)->first();
        return response()->json(['type'=>$type_sanction]);
    }
    public function update_type_sanction(Request $request)
    {
        DB::table('type_sanctions')
            ->where('id',$request->id_sanction)
            ->update(['libelle'=>$request->type]);
        $message_mod='<span class=" alert alert-success">Modification est succée</span>';
        $types=DB::table('type_sanctions')->get();
        return view('pointages.type_sanction',compact('types','message_mod'));
    }



    public function edit_type_conge($id){
        
    $type_conge=DB::table('type_demandes')->where('id',$id)->first();
        return response()->json(['type'=>$type_conge]);
    }
    public function update_type_conge(Request $request)
    {
        DB::table('type_demandes')
            ->where('id',$request->id_conge)
            ->update(['libelle'=>$request->type_conge]);
        $message_mod='<span class=" alert alert-success">Modification est succée</span>';
        $types=DB::table('type_demandes')->get();
        return view('demandes.type',compact('types','message_mod'));
    }
}
