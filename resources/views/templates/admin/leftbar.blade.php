<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
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
    <script type="text/javascript" src="{{ $adminUrl }}/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="{{ $adminUrl }}/ckfinder/ckfinder.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="{{ $adminUrl }}/img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            @php
              if (Auth::check()) {
                  $user = Auth::user();
                  $fullname  = $user->fullname;
                  $phanquyen = $user->phanquyen;
              }   
            @endphp
            <h2 class="h5">{{ $fullname }}</h2><span>{{ $phanquyen }}</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="{{ route('admin.admin.index')}}" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="{{ route('admin.admin.index')}}"> <i class="icon-home"></i>Home</a></li>
            <li><a href="{{ route('admin.cat.index')}}"> <i class="icon-form"></i>Categories</a></li>
            <li><a href="{{ route('admin.recruitment.index')}}"> <i class="fa fa-hacker-news"></i>News Recruitment</a></li>
            <li><a href="{{ route('admin.comment.index')}}"> <i class="icon-grid"></i>Comment</a></li>
            <li><a href="{{ route('admin.user.index')}}"> <i class="icon-user"></i>User</a></li>
            <li><a href="{{ route('admin.candidate.index')}}"> <i class="icon-user"></i>Candidate</a></li>
            <li><a href="{{ route('admin.recruiter.index')}}"> <i class="icon-user"></i>Recruiter</a></li>
            <li><a href="{{ route('admin.contact.index')}}"> <i class="icon-grid"></i>Contact</a></li>
            <li><a href="{{ route('admin.payment.index')}}"> <i class="icon-form"></i>Payment</a></li>
            {{-- <li><a href="{{ route('admin.apply.index')}}"> <i class="icon-grid"></i>Application</a></li> --}}
      </div>
    </nav>