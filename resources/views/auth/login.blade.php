
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
                <a href="{{ route('user.create') }} " class="link link-flotat-right">Créer un compte</a>
                <br>
                <a href="{{ route('user.forget_password') }}" class="link link-flotat-right text-danger">Mot de passe oublié</a>
            </div>
            <div class=" bg-shadow bg-light">
                    <br>
                    {!!$error ?? ''!!}
                    <br>
                    <form method="post" class="form-class" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-left" style="font-size: 12px" >E-mail :</label>

                            <div class="col-md-9">
                                <input id="email" 
                                    type="email" class="input-text" 
                                    style="box-shadow:" name="email" value="{{ old('im') }}" 
                                    required autocomplete="im"  onfocus="document.querySelector('.input-text').style.borderBottomColor='#7a0889'">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-left" style="font-size: 12px" >Mot de passe :</label>
                            <div class="col-md-9">
                                <input id="password" 
                                type="password"
                                 class="input-text2" 
                                 name="password" required
                                 autocomplete="password"
                                 onfocus="document.querySelector('.input-text2').style.borderBottomColor='#7a0889'">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-custom">
                                  Connexion
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