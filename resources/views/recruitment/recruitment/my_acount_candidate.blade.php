@extends('templates.recruitment.master')
@section('main-content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-4 col-md-0 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-orange"></i> <small class="hidden-xs-down hidden-sm-down">Quick Job Search</small></h2>
            </div><!-- end col --> --}}
            <div class="col-lg-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fa fa-user"></i>
                        @php

                        @endphp
                        <a href="{{ route('recruitment.recruitment.my_acount',['id_info' => $user->id_info])}}">Account management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-map-marker"></i>
                        <a href="{{ route('recruitment.candidate.job_application')}}">Job application</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-building"></i>
                        <a href="{{ route('recruitment.candidate.tracked_jobs')}}">Tracked Jobs</a>
                    </li>
                    {{-- <li class="breadcrumb-item">
                        <i class="fa fa-file-archive-o custom"></i>
                        <a href="{{ route('recruitment.candidate.job_application')}}">Job application</a>
                    </li> --}}

                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                   {{--  <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item status_comment">abc</li>
                        </ol>
                    </div><!-- end title --> --}}
                    <h3>Account information</h3>
                    <div class="blog-content">  
                        <div class="pp">
                            Email: <span style="font-weight: bold">{{ $user->email }}</span>
                        </div>
                        <div class="pp">
                            Phone: <span style="font-weight: bold">{{ $user->phone }}</span>
                        </div>
                        <div class="pp">
                            Password: ******  <a href="{{ route('recruitment.candidate.changepass_candidate') }}">Change Password</a>                      
                        </div>
                    </div><!-- end content -->
                    @if(Session::has('mess'))
                        <script type="text/javascript">
                            swal("Changed password successful","","success");
                        </script>
                    @endif
                    <hr class="invis1">
                    @if(Session::has('msg'))
                        <script type="text/javascript">
                            swal("Updated successful","","success");
                        </script>
                    @endif
                    <h3>Personal information</h3>
                    <div class="blog-content">
                        <form action="{{ route('recruitment.candidate.update_candidate', $id)}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full name:</label>
                                <input type="text" class="form-control" value="{{ $user->fullname }}" name="fullname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sex:</label>
                                <input type="text" class="form-control" value="{{ $user->sex }}" name="sex">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of birth:</label>
                                <input type="text" class="form-control" value="{{ $user->date_of_birth }}" name="date_of_birth">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address:</label>
                                <input type="text" class="form-control" value="{{ $user->address }}" name="address">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>  
                    </div><!-- end content -->

                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_candidate')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop