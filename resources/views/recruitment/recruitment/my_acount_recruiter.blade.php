@extends('templates.recruitment.master')
@section('main-content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-4 col-md-0 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-orange"></i> <small class="hidden-xs-down hidden-sm-down">Quick Job Search</small></h2>
            </div><!-- end col --> --}}
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fa fa-user"></i>
                        <a href="{{ route('recruitment.recruitment.my_acount',['id_info' => Auth::user()->id_info])}}">Account management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-map-marker"></i>
                        <a href="{{ route('recruitment.recruiter.publish_recruitment')}}">Published Recruitment</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="  fa fa-building"></i>
                        <a href="{{ route('recruitment.recruiter.job_listing')}}">Job listing</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-file-archive-o custom"></i>
                        <a href="{{ route('recruitment.recruiter.application_file')}}">Application File</a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-file custom"></i>
                        <a href="{{ route('recruitment.recruiter.saved_file')}}">Saved File</a>
                    </li>
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
                    <h3>Login information</h3>
                    <div class="blog-content">  
                        <div class="pp">
                            Email: <span style="font-weight: bold">{{ $user->email }}</span>
                        </div>
                        <div class="pp">
                            Password: ********** <a href="{{ route('recruitment.recruiter.changepass_recruiter') }}">Change Password</a>                      
                        </div>
                        <div class="pp">
                            Money: <span>{{ number_format($user->money) }} VNĐ</span> <a href="{{ route('recruitment.recruiter.recharge')}}">Recharge</a>
                        </div>
                    </div><!-- end content -->
                    
                    <hr class="invis1">
                    @if(Session::has('msg'))
                        <script type="text/javascript">
                            swal("Updated successful","","success");
                        </script>
                    @endif
                    @if(Session::has('message'))
                        <script type="text/javascript">
                            swal("Changed password successful","","success");
                        </script>
                    @endif
                    @if(Session::has('mess'))
                        <script type="text/javascript">
                            swal("Please confirm email to post job vacancies","","info");
                        </script>
                    @endif
                    <hr>
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.update_recruiter', [$user->id_recruiter, 'id_info' =>  Auth::user()->id_info])}}" method="post">
                        @csrf
                            <h3>Company information</h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company name: <span style="font-weight: bold">{{ $user->company_name }}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address:</label>
                                <input type="text" class="form-control" value="{{ $user->address }}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City:</label>
                                <input type="text" class="form-control" value="{{ $user->city }}" name="city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Scope of Work:</label>
                                <select name="id_cat" class="form-group-material">
                                    @foreach($type_works as $type_work)
                                    @php
                                        $id_cat = $type_work->id_cat;
                                        $cname  = $type_work->cname;
                                        $selected = '';
                                    @endphp
                                    @if($id_cat == $user->id_cat)
                                        @php
                                            $selected ='selected ="selected"';
                                        @endphp
                                    @endif
                                    <option value="{{ $id_cat }}" {{ $selected }}>{{ $cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Company profile:</p>
                                <textarea class="form-group-material" name="company_profile" required cols="50" rows="5">{{ $user->company_profile }}</textarea>
                            </div>
                            <hr>
                            <h3>Contact information</h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fullname:</label>
                                <input type="text" class="form-control" value="{{ $user->fullname_contact }}" name="fullname_contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->phone_contact }}" name="phone_contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email_contact }}" name="email_contact">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>  
                    </div><!-- end content -->

                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop