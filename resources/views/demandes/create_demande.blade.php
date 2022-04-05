@extends('layouts.app')
@section('contenu')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="{{route('create_type')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Ajouter type</a>
</div>
<div>
        {!! $message ?? '' !!}

</div >
<div class="col-md-12">
    <div class="card" style="background:#f4f2f233;">
        <div class="card-header bg-dark text-light">Demande </div>
        <div class="card-body">
         <form  id="form_add_personnel" method="POST" class="container" action="{{route('demande.store')}}">
        {{csrf_field()}}
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="num_matri">Numéro matricule :</label>
                    <input type="text" id="num_matri" name="num_matricule" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="contact">date de debut :</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control form-control-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="type">Type :</label>
                    <select name="type" id="type" class="form-control form-control-sm">
                        <option value="" selected></option>
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->libelle}}</option>
                         @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="sexe">Nombres de jour :</label>
                        <input type="number" id="nbrs" name="nbrs" class="form-control form-control-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="num_matri">Motif :</label>
                    <textarea name="motif" class="form-control form-control-sm" cols="10"></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="admin" value="admin" class="form-control form-control-sm" required>
        
        <input type="submit" value="Valider" class="btn btn-sm btn-success float-right" style="width:200px;position: absolute;right: 30px">
    </form>     
    <br>      
    <br>      
        </div>
    </div>
</div>
    
@endsection