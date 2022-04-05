@extends('layouts.app')
@section('contenu')
<div>
        {{ $message ?? '' }}
        <br>
        <br>
</div >
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{route('sanction_type_create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Ajout type sanction</a>
</div>
<div class="text-center">
<h4 class="text center">Liste des sanctions</h4>
</div>
<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon  elevation-1"><i class="fas fa-users "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sanctionnés</span>
                <span class="info-box-number">{{$liste_sanctions->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
            <br>

<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>nom</th>
            <th>Durée de la sanction</th>
            <th>Type de sanction</th>
            <th>Motifs</th>
            <th>Date </th>
            <th>Date fin</th>

        </theads>
        <tbody>
        @if($liste_sanctions->count()>0)
            @foreach ($liste_sanctions as $sanction)
            <tr>
                <td>{{$sanction->nom_prenom}}</td>
                <td>{{$sanction->nbjrs}}</td>
                <td>{{$sanction->lib}}</tdc>
                <td>Absence du {{$sanction->jour_manque}} jours</td>
                <td>{{$sanction->created_at}}</td>
                <td>{{$sanction->date_fin}}</td>

            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Aucun</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection