<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Quick Job Search</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ $publicUrl }}/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ $publicUrl }}/images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="{{ $publicUrl }}/css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="{{ $publicUrl }}/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ $publicUrl }}/style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="{{ $publicUrl }}/css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="{{ $publicUrl }}/css/colors.css" rel="stylesheet">

    <!-- Version Tech CSS for this template -->
    <link href="{{ $publicUrl }}/css/version/tech.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ $publicUrl }}/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('recruitment.index.index')}}"><img src="{{ $publicUrl }}/images/version/findjob.jpg" alt="" width="80px" height="50px"></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('recruitment.index.index')}}">Home</a>
                            </li>
                            <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                                <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                                    <li>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        <div class="container">
                                            <div class="mega-menu-content clearfix">
                                                <div class="tab">
                                                    @foreach($cats as $key => $cat)
                                                    @php
                                                        $arCats   = $cat;
                                                        $arKey    = explode('-', $key);
                                                        $id_cat   = $arKey['1'];
                                                        $cname    = $arKey['0'];
                                                        $stt++;
                                                    @endphp
                                                    @if($stt == 1)
                                                        <button class="tablinks active" onclick="openCategory(event, 'cat{{ $id_cat }}')">{{ $cname }}</button>
                                                    @else
                                                        <button class="tablinks" onclick="openCategory(event, 'cat{{ $id_cat }}')">{{ $cname }}</button>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                <div class="tab-details clearfix">
                                                    @php
                                                        $stt = 0;
                                                    @endphp
                                                    @foreach($cats as $key => $cat)
                                                    @php
                                                        $arCats   = $cat;
                                                        $arKey    = explode('-', $key);
                                                        $id_cat   = $arKey['1'];
                                                        $cname    = $arKey['0'];
                                                        $stt++;
                                                    @endphp
                                                    @if($stt == 1)
                                                        <div id="cat{{ $id_cat }}" class="tabcontent active">
                                                                <div class="row">
                                                                    @foreach($arCats as $arCat)
                                                                    @php
                                                                        $id   = $arCat['id_cat'];
                                                                        $name = $arCat['cname'];
                                                                        $slug = Str::slug($name);
                                                                    @endphp
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="blog-box">
                                                                            <div class="post-media">
                                                                                <a href="{{ route('recruitment.recruitment.cat',[$slug, $id])}}" title="">
                                                                                    <img src="{{ $publicUrl }}/upload/anh1.jpg" alt="" class="img-fluid">
                                                                                    <div class="hovereffect">
                                                                                    </div><!-- end hover -->
                                                                                    <span class="menucat">{{ $cname }}</span>
                                                                                </a>
                                                                            </div><!-- end media -->
                                                                            <div class="blog-meta">
                                                                                <h4><a href="{{ route('recruitment.recruitment.cat',[$slug, $id])}}" title="">{{ $name }}</a></h4>
                                                                            </div><!-- end meta -->
                                                                        </div><!-- end blog-box -->
                                                                    </div>
                                                                    @endforeach
                                                                </div><!-- end row -->
                                                        </div>
                                                    @else
                                                        <div id="cat{{ $id_cat }}" class="tabcontent">
                                                                <div class="row">
                                                                    @foreach($arCats as $arCat)
                                                                    @php
                                                                        $id = $arCat['id_cat'];
                                                                        $name = $arCat['cname'];
                                                                        $slug = Str::slug($name);
                                                                    @endphp
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="blog-box">
                                                                            <div class="post-media">
                                                                                <a href="{{ route('recruitment.recruitment.cat',[$slug, $id])}}" title="">
                                                                                    <img src="{{ $publicUrl }}/upload/anh1.jpg" alt="" class="img-fluid">
                                                                                    <div class="hovereffect">
                                                                                    </div><!-- end hover -->
                                                                                    <span class="menucat">{{ $cname }}</span>
                                                                                </a>
                                                                            </div><!-- end media -->
                                                                            <div class="blog-meta">
                                                                                <h4><a href="{{ route('recruitment.recruitment.cat',[$slug, $id])}}" title="">{{ $name }}</a></h4>
                                                                            </div><!-- end meta -->
                                                                        </div><!-- end blog-box -->
                                                                    </div>
                                                                    @endforeach
                                                                </div><!-- end row -->
                                                        </div>
                                                    @endif                                         
                                                    @endforeach
                                                </div><!-- end tab-details -->
                                            </div><!-- end mega-menu-content -->
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @if (Auth::check())
                            @php 
                                $user = Auth::user();
                                $id_info = $user->id_info;
                            @endphp
                                @if( $id_info == 0 )
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.admin.index')}}">Admin</a>
                                    </li> 
                                @else
                                    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recruitment.recruitment.my_acount', ['id_info' => $id_info])}}">My Acount</a>
                                    </li>
                                @endif
                            @endif           
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('recruitment.contact.contact')}}">Contact Us</a>
                            </li>
                        </ul>
    
                            @if (Auth::check())
                            @php 
                                $user     = Auth::user();
                                $fullname = $user->fullname;
                            @endphp
                                Hello, <b>{{ $fullname }}</b>
                                <a class="nav-link" href="{{ route('auth.auth.logout') }}">LogOut</a>
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Login
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="nav-link" href="{{ route('auth.auth.login') }}">Login {{-- Admin --}}</a>
                                        {{-- <a class="nav-link" href="{{ route('auth.auth.login_recruiter') }}">Login Recruiter</a>
                                        <a class="nav-link" href="{{ route('auth.auth.login_candidate') }}">Login Candidate</a> --}}
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    SignUp
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="nav-link" href="{{ route('auth.auth.register_candidate') }}">SignUp Candidate</a>
                                        <a class="nav-link" href="{{ route('auth.auth.register_recruiter') }}">SignUp Recruiter</a>
                                    </div>
                                </div>
                                
                            @endif
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->