
@extends('layouts.userlayout')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-lg-5">
        <div class="col-md-8">
            <div class="card">

               {!! $message ?? '' !!}
                <div class="card-header bg-success text-light">Bienvenue </div>

                <div class="card-body">
                    Bonjour , <?php echo Session::get('nom'); ?>
                    <br>
                    <br>
                        <?php echo Session::get('info'); ?>
                </div>
                <!-- <div class="col-md-6 offset-md-10">
                    <a href="/deconnexion" class="btn btn-danger btn-sm"> Deconnexion</a>
                </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
         document.querySelector('.alert').style.display='none';
         document.querySelector('.alert').innerHTML='';
    },4000);
</script>
@endsection()

