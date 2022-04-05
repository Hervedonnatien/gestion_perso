  <?php
  session_start();
  if (Session::get('email')!=null) {
    redirect()->to(route('logged'))->send();
  }
  ?>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet">
      <script >
        function animationMouseEnter() {
                    var x =document.querySelector('.bg-shadow');
                    var form =document.querySelector('.form-class');
                    var link_div =document.querySelector('.link-div');
                    var input_text =document.querySelector('.input-text');
                    var input_text2 =document.querySelector('.input-text2');
                    var logo_login =document.querySelector('.logo-login');
                    var y =document.querySelector('.super');
                    x.style.transform= "rotate(4deg)";
                    input_text.style.width ="60%";
                    input_text2.style.width ="60%";
                    form.style.transform= "rotate(-4deg)";
                    logo_login.style.marginTop="-70px";
                    x.style.borderTopRightRadius = "100%";
                    y.style.backgroundColor = "#c2f21a";
                    link_div.style.visibility="visible";
                    logo_login.style.visibility="visible";
                    x.style.transition="1s all";
                    y.style.transition="1s all";
                    logo_login.style.transition="1s all";
                    form.style.transition="1s all";
                    link_dev.style.transition="1.5s all";
                    input_text.style.transition="1s all";
                    input_text2.style.transition="1s all";

                }
                 function animationMouseLeave() {
                  var form =document.querySelector('.form-class');
                    var x =document.querySelector('.bg-shadow');
                    var input_text =document.querySelector('.input-text');
                    var input_text2 =document.querySelector('.input-text2');
                    var y =document.querySelector('.super');
                    var link_div =document.querySelector('.link-div');
                    var logo_login =document.querySelector('.logo-login');
                    form.style.transform= "rotate(0deg)";
                    input_text.style.width ="100%";
                    input_text2.style.width ="100%";
                    link_div.style.visibility="hidden";
                    x.style.transform= "rotate(0deg)";
                    logo_login.style.marginTop="0px";
                    x.style.borderRadius = "0px";
                    x.style.transition="1s all";
                    y.style.backgroundColor="#7a0889";
                    y.style.transition="1s all";
                    logo_login.style.transition="1s all";
                    link_dev.style.transition="1s all";
                     logo_login.style.transition="1s all";
                      input_text.style.transition="1s all";
                }
      </script>
</head>
<body>
    @yield('content')
	<script src="{{asset('bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('js/sb-admin-2.js')}}"></script>
</body>
</html>
