
@extends('layouts.public')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-lg-5">
        <div class="col-md-5 super " style="background-color: #fff;margin-top: 100px" onmouseenter="animationMouseEnter()" onmouseleave ="animationMouseLeave()">
            <div style="text-align: center;">
                <span class="logo-login">
                    <img src="{{asset('photos/images/logo.jpg')}}" width="100px" height="100px" style="border-radius: 50px">
                </span>
            </div>
            <div class="container link-div">
                <a href="/ " class="link link-flotat-right">Se connecter</a>
            </div>
            <div class=" bg-shadow bg-light ">
                    <br>
                    <?php if (count($errors)>0) { ?>
                        <?php foreach ($errors as $e) { ?>
                            <span><?php echo $e; ?></span>
                            <br>
                        <?php }?>
                    <?php }?>
                    <br>
                   <form method="get" class="form-class" action="{{ route('question_check') }}">
                        @csrf

                    <input type="hidden" class="input-text2" name="">
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-left">E-mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="input-text" name="email" value="{{ old('im') }}" required autocomplete="im" autofocus>
                            </div>
                        </div>
                            <span style="font-size: 12px"> Veuillez répondre aux questions suivantes pour récuperer votre compte:</span>
                       <br>
                       <br>

                            <div class="row ">
                                <div class="col-md-9 offset-md-2">
                                    <input id="question" type="text" width="100%" placeholder="Quelle notre animale preferée?" class="input-text3" name="question1" required>
                                </div>
                            </div>
                            <br>
                             <div class="row">
                                <div class="col-md-9 offset-md-2">
                                    <input id="question" type="text" width="" placeholder="Quelle est votre surnom d'enfance?" class="input-text3" name="question2" required>
                                </div>
                            </div>
                            <br>
                             <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6" style="float: right;">
                                <button type="submit" class="btn-custom" style="width: 150px">
                                  Récuperer
                                </button>
                            </div>
                            <br>
                        </div>
                    </form>
                    <!-- <div class="container">
                        <a href="{{ route('user.create') }} " class="link link-flotat-left">Creer un compte</a>
                    <br>
                    <a href="{{ route('user.forget_password') }}" class="link link-flotat-right text-danger" style="margin-top: -20px">Mot de passe oublié</a>
                    </div> -->
            </div>
        </div>
    </div>
</div>
@endsection()