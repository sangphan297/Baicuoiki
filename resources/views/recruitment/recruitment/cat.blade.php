['slug' => $slug, 'id' => $id]@extends('templates.recruitment.master')
@section('main-content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-orange"></i> {{ $slug }} <small class="hidden-xs-down hidden-sm-down">Nulla felis eros, varius sit amet volutpat non. </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Catogories</a></li>
                    <li class="breadcrumb-item active">{{ $slug }}</li>
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title">Job Seeking</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                <form action="{{ route('recruitment.recruitment.search',[$slug,$id])}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="city" value="" placeholder="City">
                                        <select name="gender_requirement" class="custom-select">
                                            <option value="">Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Not required">Not required</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="level" class="custom-select">
                                            <option value="">Level</option>
                                            <option value="University">University</option>
                                            <option value="Colleges">Colleges</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Not required">Not required</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="experience" class="custom-select">
                                            <option value="">Experience</option>
                                            <option value="1 year">1 year</option>
                                            <option value="2 years">2 years</option>
                                            <option value="3 years">3 years</option>
                                            <option value="Over 2 years">Over 3 years</option>
                                            <option value="Not required">Not required</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="type_work" class="custom-select">
                                            <option value="">Type Work</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Freelance">Freelance</option>
                                            <option value="Intership">Intership</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="probationary_period" class="custom-select">
                                            <option value="">Probationary Period</option>
                                            <option value="Get this job now">Get this job now</option>
                                            <option value="1 month">1 month</option>
                                            <option value="2 months">2 months</option>
                                            <option value="3 months">3 months</option>
                                            <option value="Exchange through the interview">Exchange through the interview</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="rate" class="custom-select">
                                            <option value="">Rate</option>
                                            <option value="200-300$">200-300$</option>
                                            <option value="300-500$">300-500$</option>
                                            <option value="500-1000$">500-1000$</option>
                                            <option value="Over 1000$">Over 1000$</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form> 
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end col -->
            
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-grid-system">
                        <div class="row">
                            @foreach($recruitments as $recruitment)
                            @php
                                $id_recruitment = $recruitment->id_recruitment;
                                $rname          = $recruitment->rname;
                                $picture        = $recruitment->picture;
                                $created_at     = $recruitment->created_at;
                                $views          = $recruitment->views;
                                $description    = Str::limit($recruitment->description, 100);
                                $fullname       = $recruitment->fullname;
                                $cname          = $recruitment->cname;
                                $status         = $recruitment->status;

                                $slug      = Str::slug($rname);
                                $urlDetail = route('recruitment.recruitment.detail',[$slug, $id_recruitment]);
                                $urlPic  = '/storage/app/public/'.$picture;
                            @endphp
                            @if($status == 1)
                                <div class="col-md-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="{{ $urlDetail }}" title="">
                                                <img src="{{ $urlPic }}" alt="" {{-- class="img-fluid" --}} height="200px">
                                                <div class="hovereffect">
                                                    <span></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta big-meta">
                                            <h4><a href="{{ $urlDetail}}" title="">{{ $rname }}</a></h4>
                                            <p>{!! $description !!}</p>
                                            <small class="firstsmall"><a class="bg-orange" >{{ $cname }}</a></small>
                                            <small><a href="{{ $urlDetail}}" title="">{{ $created_at }}</a></small>
                                            <small><a href="tech-author.html" title="">by {{ $fullname }}</a></small>
                                            <small><a href="{{ $urlDetail}}" title=""><i class="fa fa-eye"></i> {{ $views }}</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                            @endif
                            @endforeach
                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div><!-- end page-wrapper -->

                <hr class="invis3">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                {!! $recruitments->links() !!}
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop