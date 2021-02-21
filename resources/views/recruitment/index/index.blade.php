@extends('templates.recruitment.master')
@section('main-content')
<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            @php
                $stt = 0;
            @endphp
            @foreach($recruitmentPopulars as $recruitmentPopular)
            @php
                $id_recruitment = $recruitmentPopular->id_recruitment;
                $rname          = $recruitmentPopular->rname;
                $picture        = $recruitmentPopular->picture;
                $created_at     = $recruitmentPopular->created_at;
                $views          = $recruitmentPopular->views;
                $description    = Str::limit($recruitmentPopular->description, 100);
                $fullname       = $recruitmentPopular->fullname;
                $cname          = $recruitmentPopular->cname;
                $status         = $recruitmentPopular->status;

                $slug      = Str::slug($rname);
                $urlDetail = route('recruitment.recruitment.detail',[$slug, $id_recruitment]);

                $urlPic  = '/storage/app/public/'.$picture;
                $stt++;
            @endphp
            @if($status == 1)
                @if($stt == 1)
                <div class="first-slot">
                    <div class="masonry-box post-media">
                         <img src="{{ $urlPic }}" alt="" {{-- class="img-fluid" --}} height="350px">
                         <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-orange"><a href="{{ $urlDetail }}" title="">{{ $cname }}</a></span>
                                    <h4><a href="{{ $urlDetail}}" title="">{{ $rname }}</a></h4>
                                    <small><a href="{{ $urlDetail}}" title="">{{ $created_at }}</a></small>
                                    <small><a href="tech-author.html" title="">by {{ $fullname }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                    </div><!-- end post-media -->
                </div><!-- end first-side -->
                @elseif($stt == 2)
                <div class="second-slot">
                    <div class="masonry-box post-media">
                         <img src="{{ $urlPic }}" alt="" {{-- class="img-fluid" --}} height="350px">
                         <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-orange"><a href="{{ $urlDetail }}" title="">{{ $cname }}</a></span>
                                    <h4><a href="{{ $urlDetail}}" title="">{{ $rname }}</a></h4>
                                    <small><a href="{{ $urlDetail}}" title="">{{ $created_at }}</a></small>
                                    <small><a href="tech-author.html" title="">by {{ $fullname }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                         </div><!-- end shadow -->
                    </div><!-- end post-media -->
                </div><!-- end second-side -->
                @else
                <div class="last-slot">
                    <div class="masonry-box post-media">
                         <img src="{{ $urlPic }}" alt="" {{-- class="img-fluid" --}} height="350px">
                         <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-orange"><a href="{{ $urlDetail }}" title="">{{ $cname }}</a></span>
                                    <h4><a href="{{ $urlDetail}}" title="">{{ $rname }}</a></h4>
                                    <small><a href="{{ $urlDetail}}" title="">{{ $created_at }}</a></small>
                                    <small><a href="tech-author.html" title="">by {{ $fullname }}</a></small>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                         </div><!-- end shadow -->
                    </div><!-- end post-media -->
                </div><!-- end second-side --> 
                @endif
            @endif
            @endforeach
        </div><!-- end masonry -->
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->
                    <div class="blog-list clearfix">
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
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{ $urlDetail }}" title="">
                                        <img src="{{ $urlPic }}" alt="" {{-- class="img-fluid" --}} height="200px">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{ $urlDetail}}" title="">{{ $rname }}</a></h4>
                                <p>{!! $description !!}</p>
                                <small class="firstsmall"><a class="bg-orange" >{{ $cname }}</a></small>
                                <small><a href="{{ $urlDetail}}" title="">{{ $created_at }}</a></small>
                                <small><a href="tech-author.html" title="">by {{ $fullname }}</a></small>
                                <small><a href="{{ $urlDetail}}" title=""><i class="fa fa-eye"></i> {{ $views }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->

                        <hr class="invis">
                    @endif
                    @endforeach
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

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

          @include('templates.recruitment.leftbar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop