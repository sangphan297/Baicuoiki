@extends('templates.recruitment.master')
@section('main-content')
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <h2 style="text-align: center;">Apply For This Job</h2>
                    <div class="row">
                        <div class="col-lg-3">
                            
                        </div>
                        <div class="col-lg-9">  
                            @if (Session::has('msg'))
                                <p style="color: red; margin-left: 30px;">{{ Session::get('msg') }}</p>
                            @endif
                            <form class="form-wrapper" action="{{ route('recruitment.candidate.recruitment',$id_recruitment)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control" placeholder="Your name" name="fullname" required="" value="{{ Auth::user()->fullname}}">
                                <input type="email" class="form-control" placeholder="Email address" name="email" required="" value="{{ Auth::user()->email}}">
                                <input type="text" class="form-control" placeholder="Phone" name="phone" required="">
                                <label>Upload Your CV - Max. File size: 2MB.<input type="file" class="form-control" name="cv" multiple="multiple" required=""></label>
                                <textarea class="form-control" placeholder="Your message" name="message" required=""></textarea>
                                <button type="submit" class="btn btn-primary">Send Application<i class="fa fa-envelope-open-o"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop