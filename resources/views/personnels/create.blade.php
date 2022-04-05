@extends('layouts.app')
@section('contenu')
<div>
        {{ $message ?? '' }}
        <br>
        <br>
</div>
    <form  id="form_add_personnel" method="POST"  action="/registre"  enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="num_matri">Numéro matricule :</label>
                    <input type="text" id="num_matri" name="num_matri" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nom_complet">Nom et Prénom :</label>
                    <input type="text" id="nom_complet" name="nom_complet" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="email">Addresse e-mail :</label>
                    <input type="text" id="email" name="email" class="form-control form-control-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="contact">Contact :</label>
                    <input type="text" id="contact" name="contact" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select name="sexe" id="sexe" class="form-control form-control-sm">
                        <option value="" selected></option>
                        <option value="Masculin">Masculin</option>
                        <option value="Feminin">Féminin</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="situation">Situation familiale :</label>
                    <select name="situation" id="situation" class="form-control form-control-sm"></select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="profile">Profile :</label>
                   <input type="file" name="profile" id="profile" required>
                </div>
            </div>
        </div>
        <input type="submit" value="Enregister" class="btn btn-sm btn-success" style="width:200px">
    </form>
@endsection