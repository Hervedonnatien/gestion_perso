@extends('layouts.app')

@section('contenu')
<div class="text-center">
<h4 class="text center">Liste du personnel</h4>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="#" data-toggle="modal" data-target="#modal_personnel" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Ajout personnel</a>
</div>
 {!!$notify ?? ''!!}
    @if ($errors->any())
    <div class="alert alert-danger" style="font-weight: bold;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br><br>
<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>Numéro matricule</th>
            <th>Nom et prenom</th>
            <th>Addresse mail</th>
            <th>téléphone</th>
            <th>Genre</th>
            <th>Situation familiale</th>
            <th>Action</th>
        </thead>
        <tbody>
        @if($personnels->count()>0)
            @foreach ($personnels as $personnel)
            <tr>
                <td>{{$personnel->num_matricule}}</td>
                <td>{{$personnel->nom_prenom}}</td>
                <td>{{$personnel->email}}</td>
                <td>{{$personnel->telephone}}</td>
                <td>{{$personnel->sexe}}</td>
                <td>{{$personnel->situation_familiale}}</td>
                <td><a href="{{route('show',$personnel->num_matricule)}}" class=" text-primary "><i class="fas fa-eye "></i></a></td>
                <!-- <td><a href="personnel/{{$personnel->num_matricule}}/edit" class=" text-primary "><i class="fas fa-edit "></i></a></td>
                <td><a href="personnel/delete/'{{$personnel->num_matricule}}" class=" text-danger "><i class="fas fa-eye "></i></a></td> -->
            </tr>
            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Liste vide</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection