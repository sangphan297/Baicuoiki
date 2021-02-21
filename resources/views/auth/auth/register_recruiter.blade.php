<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Recruiter</title>
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
            <div class="logo text-uppercase"><span>Sign up for  </span><strong class="text-primary">the Recruitment system</strong></div>   
            <form class="text-left form-validate" action="{{ route('auth.auth.register_recruiter')}}" method="post">
              @csrf
              <div class="form-group-material">
                <input id="register-email" type="email" name="email" required data-msg="Please enter a valid email address" class="input-material" placeholder="Email">
                <label for="register-email" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-password" type="password" name="password" required data-msg="Please enter your password" class="input-material" placeholder="Password">
                <label for="register-password" class="label-material"></label>
              </div>
                <div class="form-group-material">
                <input id="register-password" type="password" name="confirm_password" required data-msg="Please enter your confirm password" class="input-material" placeholder="Confirm Password">
                <label for="register-password" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="fullname" required data-msg="Please enter your fullname" class="input-material" placeholder="Fullname">
                <label for="register-fullname" class="label-material"></label>
              </div>
              <div>Company Information:</div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="company_name" required data-msg="Please enter your Company name" class="input-material" placeholder="Company name">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="city" required data-msg="Please enter your City" class="input-material" placeholder="City">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="address" required data-msg="Please enter your Address" class="input-material" placeholder="Address">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <label for="register-company_name" class="label-material">Scope of Work</label>
                <select name="id_cat" class="form-group-material">
                  @foreach($cats as $cat)
                  @php
                    $id_cat = $cat->id_cat;
                    $cname  = $cat->cname;
                  @endphp
                  <option value="{{ $id_cat }}">{{ $cname }}</option>
                  @endforeach
                </select>
              </div>
              <label for="register-company_name" class="label-material">Company Profile</label>
              <div class="form-group-material">
                <textarea name="company_profile" required data-msg="Please enter your Company Profile" class="input-material" placeholder="Company Profile" cols="50" rows="5"></textarea>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="fullname_contact" required data-msg="Please enter your Fullname Contact" class="input-material" placeholder="Fullname Contact">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="phone_contact" required data-msg="Please enter your Phone Contact" class="input-material" placeholder="Phone Contact">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group-material">
                <input id="register-fullname" type="text" name="email_contact" required data-msg="Please enter your Email Contact" class="input-material" placeholder="Email Contact">
                <label for="register-company_name" class="label-material"></label>
              </div>
              <div class="form-group text-center">
                <input id="register" type="submit" value="Register" class="btn btn-primary">
              </div>
            </form>
            @if (Session::has('msg'))
              <p style="color: red; margin-left: 30px; margin-bottom: 15px;">{{ Session::get('msg') }}</p>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger" style="margin-left: 30px;">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            <small>Already have an account? </small><a href="{{ route('auth.auth.login')}}" class="signup">Login</a>
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