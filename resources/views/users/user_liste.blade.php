@extends('layouts.app')

@section('contenu')
<div class="text-center">
<h4 class="text center">Liste des utilisateurs</h4>
</div>
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Liste de pointage </a>
</div> -->
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
            <th>Nom et prenom</th>
            <th>E-mail</th>
            <th>ROLE</th>
            <th>Action</th>
        </theads>
        <tbody>
        @if($users->count()>0)
            @foreach ($users as $user)
            <tr class="text-center">
                <td>{{$user->nom_prenom}}</td>
                <td>{{$user->email_personnel}}</td>
                <td>{{$user->role}}</td>
                <td><a href="{{route('show',$user->personnel_num_matricule)}}" class=" text-primary "><i class="fas fa-eye "></i></a></td>
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