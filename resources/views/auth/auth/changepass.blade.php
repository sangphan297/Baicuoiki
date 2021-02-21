<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Change Password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ $adminUrl }}/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ $adminUrl }}/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ $adminUrl }}/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ $adminUrl }}/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ $adminUrl }}/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ $adminUrl }}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ $adminUrl }}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ $adminUrl }}/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
           <div class="logo text-uppercase"><strong class="text-primary">Please enter your information</strong></div>
            <p></p>
            <form method="post" action="{{route('auth.auth.changepass',['id_user' => $id_user])}}" class="text-left form-validate">
              @csrf
              <div class="form-group-material">
                <input id="login-username" type="password" name="password" required data-msg="Please enter your username" class="input-material" placeholder="Password">
                <label for="login-username" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="passwordconfirm" required data-msg="Please enter your password" class="input-material" placeholder="PasswordConfirm">
                <label for="login-password" class="label-material"></label>
              </div>
              <div class="form-group text-center">
                 <input id="register" type="submit" value="Send" class="btn btn-primary">
                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
              </div>
            </form>
            @if (Session::has('msg'))
              <p style="color: red; margin-left: 30px; margin-bottom: 15px;">{{ Session::get('msg') }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ $adminUrl }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ $adminUrl }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $adminUrl }}/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="{{ $adminUrl }}/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{ $adminUrl }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ $adminUrl }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ $adminUrl }}/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="{{ $adminUrl }}/js/front.js"></script>
  </body>
</html>