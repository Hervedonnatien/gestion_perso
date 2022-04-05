@extends('layouts.app')

@section('contenu')
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
	<form method="GET" style="position: absolute;right: 0px">
    <input type="date" class=" form-control form-control-sm" placeholder="">

	</form>
</div> -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <form method="get" action="{{route('histo_all')}}">
      @csrf
      <input type="date" name="date" value="{{$date ?? ''}}">
      <input type="submit" value="voir">
    </form>
</div>
<br>
<div class="text-center">
<h4 class="text center">Historique des pointages du jour</h4>
</div>
<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon  elevation-1"><i class="fas fa-users "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Effectif des pointages</span>
                <span class="info-box-number">{{$pointages->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
            <br>

<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>Numéro matricule</th>
            <th>Nom et prénom</th>
            <th>Heure d'entrée</th>
            <th>Heure sortie</th>
            <th>Date : heure</th>
        </theads>
        <tbody>
        @if($pointages->count()>0)
            @foreach ($pointages as $pointage)
            <tr>
                <td>{{$pointage->im}}</td>
                <td>{{$pointage->nom_prenom}}</td>
                <td>{{$pointage->heure_entre}}</td>
                <td>{{$pointage->heure_sortie}}</td>
                <td>{{ $pointage->created_at}}</td>
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