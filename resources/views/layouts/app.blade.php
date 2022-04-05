<?php
  session_start();
  if (Session::get('email')==null) {
    redirect()->to(route('outside_user'))->send();
  }
  if (Session::get('role')!='ROLE_ADMIN') {
      redirect()->to(route('logged'))->send();
  } 
  $date_now=date("Y-m-d");
      function date_complete($date1)
      {
        $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
        $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
        return $date_done;
      }
      $heure='17:28:00 ';
  ?>
<!DOCTYPE html>
<html>
 
    <head>
        <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <meta name="description" content="">
          <meta name="author" content="">
        <title>Gestion</title>
             <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
            <link href="{{asset('css/w3.css')}}" rel="stylesheet">
            <link href="{{asset('css/app.css')}}" rel="stylesheet">
            <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
            <link href="{{asset('bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet">
    </head>
    <body id="page-top" style="font-size:12px;">
        <div  style="position: absolute;bottom: 21px;left: 30px" >
            <a href="{{route('histo_pointage')}}" id="bilan"   class="btn btn-sm  btn-warning text-light ">Bilan d'aujourd'hui</a>
        </div>

            <div id="wrapper">
                <!-- Sidebar -->
                <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar"  style="background:#7a06d0">
                <!-- Sidebar - Brand -->
                 <span class=" d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{asset('photos/images/logo.jpg')}}" width="200px" height="150px" style="border-radius: 50%">
                </div>
                    <div class="sidebar-brand-text mx-3"></sup></div>
                </span>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item  ">
                    <a class="nav-link text-light text-uppercase" href="/index">
                    <i class="fas fa-fw fa-tachometer-alt text-light"></i>
                    <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed text-light" id="gestion_produit" href="/personnels" >
                    <i class="fas fa-fw fa-cog text-light"></i>
                    <span class="text-uppercase" > Personnel </span>
                    </a>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <li class="nav-item">
                    <a class="nav-link collapsed text-light" id="gestion_produit" href="{{route('demande.index')}}" >
                    <i class="fas fa-fw fa-cog text-light"></i>
                    <span class="text-uppercase" > Demandes du staff </span>
                    </a>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- Divider -->
                <hr class="sidebar-divider">
                    <li class="nav-item">
                    <a class="nav-link collapsed text-light" id="gestion_produit" href="{{route('user.index')}}" >
                    <i class="fas fa-fw fa-cog text-light"></i>
                    <span class="text-uppercase" >Utilisateur </span>
                    </a>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- Divider -->
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Addons
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Fonctionnalité</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Autres:</h6>
                        <a class="collapse-item" href="{{route('bilan_list')}}">Absence et sanction</a>
                        <a class="collapse-item" href="{{route('pointage.index')}}">Pointage</a>
                        <a class="collapse-item" href="{{route('histo_all')}}">Historique</a>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">


                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content" style="">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background: ;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link  text-light rounded-circle mr-3">
                        <i class="fa fa-bars"></i> 
                    </button> 
                    <button class="btn btn-link text-light ">
                        <i class="fas fa-comments "></i>
                    </button>
                    <!-- Topbar Search -->
                    
                    <span id="demo">

                    </span>
                    <span class="float-right" style="position: absolute;right: 320px">
                     Bonjour <?php echo '<strong>'.Session::get('nom').'</strong>, Nous sommes le <strong>'.date_complete($date_now).'</strong>' ?>

                    </span>           

                        <a  href="#" data-toggle="modal" data-target="#deconnexion" style="position: absolute;right: 20px" class="btn btn-danger btn-sm float-right">Deconnexion</a>

                    <!-- Topbar Navbar -->

                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid"  id="contenu"
                        style="height:510px;
                               ">
    
                     
                    <!-- Page Heading -->
                    <!-- Content Row -->
                    @yield('contenu')
                    <span class="float-left" style="left: 50px;">
                     <input type="button" onclick="window.history.back()" value="Retour" class=" btn btn-sm btn-danger">
                    </span>
                </div>
            </div>
            <!-- End of Content Wrapper -->
               <script src="{{asset('bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
              <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
              <script src="{{asset('js/app.js')}}"></script>
              <script src="{{asset('js/sb-admin-2.js')}}"></script>
              <script type="text/javascript">
                    var myVar = setInterval(myTimer, 1000);
                        function myTimer(){
                          var d = new Date();
                          document.getElementById("demo").innerHTML = d.toLocaleTimeString();
                          if (d.toLocaleTimeString()<'{{$heure}}') {
                            $("#bilan").click();
                        }
                    }
              </script>
    </body>
    @include('modal.all_modal')
</html>