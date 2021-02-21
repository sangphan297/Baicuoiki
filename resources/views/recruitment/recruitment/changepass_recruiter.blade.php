@extends('templates.recruitment.master')
@section('main-content')
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
                    <h3>Change Password</h3>
                    @if (Session::has('mess'))
                      <p style="color: red;">{{ Session::get('mess') }}</p>
                    @endif
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.changepass_recruiter')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password:</label>
                                <input type="password" class="form-control" value="" name="old_pass">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password:</label>
                                <input type="password" class="form-control" value="" name="new_pass">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password:</label>
                                <input type="password" class="form-control" value="" name="confirm_pass">
                            </div>           
                            <button type="submit" class="btn btn-primary">Change</button>
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