@extends('layouts.app')

@section('contenu')
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
	<form method="GET" style="position: absolute;right: 0px">
    <input type="date" class=" form-control form-control-sm" placeholder="">

	</form>
</div> -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="{{route('demande.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Ajouter congés</a>
</div>
<br>
<div class="text-center">
<h4 class="text center">Congé</h4>
</div>


<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>Numero matricule</th>
            <th>Date debut</th>
            <th>Date fin</th>
            <th>Motif</th>
            <th>Date de demande</th>
            <th>Etat</th>
        </theads>
        <tbody>
        @if($demandes->count()>0)
            @foreach ($demandes as $demande)
            <tr>
                <td>{{$demande->personnel_num_matricule}}</td>
                <td>{{$demande->date_debut}}</td>
                <td>{{$demande->date_fin}}</td>
                <td>{{$demande->motif}}</td>
                <td>{{$demande->created_at}}</td>
                <?php $dexpire=(strtotime( date('Y-m-d')) - strtotime($demande->date_fin))/86400;
                 $dvalable=(strtotime($demande->date_fin) - strtotime(date('Y-m-d')))/86400;
                 $en_attante=(strtotime($demande->date_debut) - strtotime(date('Y-m-d')))/86400;
                 $bottom='';
                    $bottom_show='';

                 if ($demande->date_fin <= date('Y-m-d')) {
                    $bottom ='disabled';
                    $bottom_show ='disabled';

                 }elseif ($demande->date_debut <= date('Y-m-d')) {
                    $texte_show='<span  class="badge badge-success" style="font-size:10px"><i class="far fa-clock"></i> En cours dans   '.$dvalable.'  jours</span> ';
                    $bottom ='disabled';

                 }elseif ($demande->date_debut > date('Y-m-d')) {
                    $bottom='';

                    $texte_show='<span  class="badge badge-success" style="font-size:10px"><i class="far fa-clock"></i> En attente dans  '.$en_attante.' jours</span> ';
                 }else{
                    $bottom='';

                 }
                ?>
                <td style="font-weight: bolder;width: auto" class=" text-center alert text-{{$demande->date_fin <= date('Y-m-d') ? 'warning':'success' }}">
                    {!!$demande->date_fin <= date('Y-m-d') ? '<span  class="badge badge-warning" style="font-size:10px;color:#fff"><i class="far fa-clock"></i> expiré ,il y a   '.$dexpire.'  jours </span> ': $texte_show !!}
                </td>
            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Aucun demande</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection