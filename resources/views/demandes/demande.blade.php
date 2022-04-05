@extends('layouts.userlayout')
@section('content')
<div class="row justify-content-center mt-lg-5">
    <div class="col-md-6">
        {!! $message ?? '' !!}
        <div class="card" >
            <div class="card-header  ">Demande </div>
            <div class="card-body">
             <form  id="form_add_personnel" method="POST" class="container" action="{{route('demande.store')}}">
            {{csrf_field()}}

                <input type="hidden" id="num_matri" name="num_matricule" value=" <?php echo Session::get('im_user'); ?>
                " class="form-control form-control-sm" required>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label for="contact">Date de debut :</label>
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
            
            <input type="submit" value="Envoyer" class="btn btn-sm btn-success float-right" style="width:200px;position: absolute;right: 30px">
        </form>     
        <br>      
        <br>      
            </div>
        </div>
    </div>
</div>
    
@endsection