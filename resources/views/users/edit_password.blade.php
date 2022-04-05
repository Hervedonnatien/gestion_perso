@extends('layouts.userlayout')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-lg-5">
        <div class="col-md-5">
            <span id="alert">
               {!! $message ?? '' !!}
            </span>
            <div class="card">
                <div class="card-header  text-dark">Modification </div>

                <div class="card-body">
                   <form action="{{route('update_password')}}" method="post">
                        @csrf()
                        @method('PUT')
                        <input type="password" name="p0" placeholder="Ancien mot de passe" required  class="form-control form-control-sm">
                        <br>
                        <input type="password" name="p1" placeholder="Nouveau mot de passe" required class="form-control form-control-sm">
                        <br>
                        <input type="password" name="p2" placeholder="Comfirmation  mot de passe" required class="form-control form-control-sm">
                        <br>
                        <input type="submit" class="btn btn-block btn-warning btn-sm" value="Enregistrer">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
         document.querySelector('#alert').style.display='none';
         document.querySelector('#alert').innerHTML='';
    },4000);
</script>
@endsection()