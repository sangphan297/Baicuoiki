@extends('templates.recruitment.master')
@section('main-content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-envelope-open-o bg-orange"></i> Contact us <small class="hidden-xs-down hidden-sm-down">Nulla felis eros, varius sit amet volutpat non. </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <h4>Who we are</h4>
                            <p>Quick Job Search is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
           
                            <h4>How we help?</h4>
                            <p>Etiam vulputate urna id libero auctor maximus. Nulla dignissim ligula diam, in sollicitudin ligula congue quis turpis dui urna nibhs. </p>
     
                            <h4>Pre-Sale Question</h4>
                            <p>Fusce dapibus nunc quis quam tempor vestibulum sit amet consequat enim. Pellentesque blandit hendrerit placerat. Integertis non.</p>
                        </div>
                        <div class="col-lg-7">  
                            @if (Session::has('msg'))
                                <p style="color: red; margin-left: 30px;">{{ Session::get('msg') }}</p>
                            @endif
                            <form class="form-wrapper" action="{{ route('recruitment.contact.contact')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" placeholder="Your name" name="name">
                                <input type="text" class="form-control" placeholder="Email address" name="email">
                                <input type="text" class="form-control" placeholder="Phone" name="phone">
                                <input type="text" class="form-control" placeholder="Subject" name="subject">
                                <textarea class="form-control" placeholder="Your message" name="message"></textarea>
                                <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop