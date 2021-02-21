@extends('templates.recruitment.master')
@section('main-content')
<section class="section single-wrapper">
    <div class="container">
        @if(Session::has('msg'))
            <script type="text/javascript">
                swal("Modify successful","","success");
            </script>
        @endif
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    @php
                        $id_recruitment      = $recruitment->id_recruitment;
                        $rname               = $recruitment->rname;
                        $cname               = $recruitment->cname;
                        $created_at          = $recruitment->created_at;
                        $views               = $recruitment->views;
                        $fullname            = $recruitment->fullname;
                        $id_cat              = $recruitment->id_cat;
                        $amount              = $recruitment->amount;
                        $rate                = $recruitment->rate;
                        $gender_requirement  = $recruitment->gender_requirement;
                        $address             = $recruitment->address;
                        $type_work           = $recruitment->type_work;
                        $description         = $recruitment->description;
                        $experience          = $recruitment->experience;
                        $level               = $recruitment->level;
                        $city                = $recruitment->city;
                        $probationary_period = $recruitment->probationary_period;
                        $job_requirement     = $recruitment->job_requirement;
                        $expired_time        = $recruitment->expired_time;
                        $benefit             = $recruitment->benefit;
                        $picture             = $recruitment->picture;
                        $fullname_contact    = $recruitment->fullname_contact;
                        $email_contact       = $recruitment->email_contact;
                        $phone_contact       = $recruitment->phone_contact;

                        $slug      = Str::slug($rname);
                        $urlDetail = route('recruitment.recruitment.detail',[$slug, $id_recruitment]);
                        $urlPic  = '/storage/app/public/'.$picture;
                    @endphp
                    <div class="blog-title-area text-center">

                        <h3>{{ $rname}}</h3>

                    </div><!-- end title -->

                    <div class="single-post-media">
                        <img src="{{ $urlPic}}" alt="" width="300px" height="300px">
                    </div><!-- end media -->

                    <div class="blog-content">
                        <div class="pp">
                            <div>
                                <p><span style="font-weight: bold">-Rate:</span>{{$rate}}</p>
                                <p><span style="font-weight: bold">-Experience:</span>{{$experience}}</p>
                                <p><span style="font-weight: bold">-Address:</span>{{$address}}</p>
                                <p><span style="font-weight: bold">-City:</span>{{$city}}</p>
                                <p><span style="font-weight: bold">-Job Title:</span>{{$cname}}</p>
                            </div>
                            <div style="margin-left: 400px;margin-top: -270px;">
                                <p><span style="font-weight: bold">-Amount:</span> {{$amount}}</p>
                                <p><span style="font-weight: bold">-Gender Requirement:</span> {{$gender_requirement}}</p>
                                <p><span style="font-weight: bold">-Type work:</span> {{$type_work}}</p>
                                <p><span style="font-weight: bold">-Probationary Period:</span> {{$probationary_period}}</p>
                                <p><span style="font-weight: bold">-Level:</span> {{$level}}</p>
                            </div>
                        </div>  
                        <div class="pp">
                            <span style="font-weight: bold">Description:</span> {!! $description !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Job Requirement:</span> {!! $job_requirement !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Benefit:</span> {!! $benefit !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Expired Time:</span> <span style="color: red">{!! $expired_time !!}</span>
                        </div><!-- end pp -->
                        <hr>
                        <h3>Contact Information</h3>
                         <div class="pp">
                            <span style="font-weight: bold">Fullname:</span> {!! $fullname_contact !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Phone:</span> {!! $phone_contact !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Email:</span> {!! $email_contact !!}
                        </div><!-- end pp -->
                    </div><!-- end content -->
                    <hr class="invis1">
                    <div style="text-align: center">
                        <button type="submit" class="btn btn-primary"><a href="{{ route('recruitment.recruiter.modify_recruitment',$id_recruitment)}}">Modify</a></button>
                        <button type="submit" class="btn btn-primary"><a href="{{ route('recruitment.recruiter.del_recruitment',$id_recruitment)}}">Delete</a></button>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop