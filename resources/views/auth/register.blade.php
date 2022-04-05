@extends('layouts.public')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-lg-5">
        <div class="col-md-8 super " style="background-color: #fff;margin-top: 30px" onmouseenter="animationMouseEnter()" onmouseleave ="animationMouseLeave()">
            <div style="text-align: center;">
                <span class="logo-login">
                    <img src="{{asset('photos/images/logo.jpg')}}" width="100px" height="100px" style="border-radius: 50px">
                </span>
            </div>
            <div class="container link-div">
                <a href="/ " class="link link-flotat-right">Se connecter</a>
            </div>
            <div class=" bg-shadow bg-light " style="padding-top: 20px">
                   <?php if (count($errors)>0) { ?>
                        <?php foreach ($errors as $e) { ?>
                            <span><?php echo $e; ?></span>
                            <br>
                        <?php }?>
                    <?php }?>
                    <form method="POST" class="form-class" action="{{ route('user.store') }}">
                        @csrf  
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right" style="font-size: 12px">N° matricule :</label>

                            <div class="col-md-6">
                                <input id="im" type="text" class=" input-text2" name="im" value="{{ old('im') }}" required autocomplete="im" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right" style="font-size: 12px">Mot de passe :</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="input-text" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-3 col-form-label text-md-right"  style="font-size: 12px">Confirmation :</label>
                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="input-text" name="confirm_password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="identite" class="col-md-3 col-form-label text-md-right"  style="font-size: 12px">Identité secret : </label>
                            <div class="col-md-6">
                                <input id="secret" type="text" placeholder="xxxx-xxxx-xxxexample@exemple.com" class="input-text" name="secret" required>
                            </div>
                        </div> 
                        <hr>
                            <h6> Veuillez répondre aux questions suivantes:</h6>
                            <div class="row ">
                                <div class="col-md-6 offset-md-3">
                                    <input id="secret" type="text"  placeholder="Quelle notre animale preferée?" style="font-size: 12px" class="input-text" name="question1" required>
                                </div>
                            </div>
                            <br>
                             <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <input id="secret" type="text" placeholder="Quelle est votre surnom d'enfance?" class="input-text" name="question2" required>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-custom">
                                  Enregistrer
                                </button>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()