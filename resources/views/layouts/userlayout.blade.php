  <?php
  session_start();
  if (Session::get('email')==null) {
    redirect()->to(route('outside_user'))->send();
  }
  ?>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/w3.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    
</head>
<body  style="font-size: 12px;background-color: #7a0889">
  <nav class="navbar navbar-expand-lg navbar-dark ">
  <a class="navbar-brand" href="/logged" style="font-size: 12px">GESTION DE POINTAGE</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navb">
    <ul class="navbar-nav mr-auto">
      @if(session::get('role')=='ROLE_ADMIN')
      <li class="nav-item">
        <a class="nav-link" href="/index">Administration</a>
      </li>
      @else()
      <li class="nav-item">
        <a class="nav-link" href="{{route('demande_create')}}">Demande<i class="fas fa-ask"></i></a>
      </li>
      @endif()
        <li class="nav-item ">
        <a class="nav-link text-warning" href="{{route('edit_password')}}">Changer le mot de passe <i class="fas fa-key"></i></a>
      </li>
    </ul>
      <a  href="#" data-toggle="modal" data-target="#deconnexion" class="btn btn-danger btn-sm float-right">Deconnexion</a>

</nav>
<hr>
    @include('modal.all_modal')

    @yield('content')
	<script src="{{asset('bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/sb-admin-2.js')}}"></script>
</body>
</html>
