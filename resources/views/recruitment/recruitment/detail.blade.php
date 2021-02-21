@extends('templates.recruitment.master')
@section('main-content')
<section class="section single-wrapper">
    <div class="container">
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
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item status_comment">{{ $rname}}</li>
                        </ol>

                        <span class="color-orange"><a href="" title="">{{ $cname}}</a></span>

                        <h3>{{ $rname}}</h3>

                        <div class="blog-meta big-meta">
                            <small>{{ $created_at}}</small>
                            <small>by {{ $fullname}}</small>
                            <small><i class="fa fa-eye"></i> {{ $views}}</small>
                            <small id="ketqua_follow">
                                @csrf
                                @if($status_follow == 0)
                                    <a href="javascript:void(0)" onclick="changeStatus({{ $status_follow }},{{ $id_recruitment }})">Follow<a/>
                                @else
                                    <a href="javascript:void(0)" onclick="changeStatus({{ $status_follow }},{{ $id_recruitment }})">UnFollow<a/>
                                @endif
                            </small>
                        </div><!-- end meta -->
                    </div><!-- end title -->
                    <script type="text/javascript">
                        function changeStatus(status_follow, id_recruitment) {
                            var _token = $('input[name=_token]').val();
                            $.ajax({
                                url: '{{ route('recruitment.recruitment.follow') }}',
                                type: 'POST',
                                data: {
                                    status_follow:status_follow,
                                    id_recruitment:id_recruitment,
                                    '_token':_token
                                },
                                success: function(data){
                                    if (data == 'NOK') {
                                        swal("Please log in","","warning");
                                    }else{
                                        if (data == 'NYOU') {
                                            swal("You are not authorized to perform this function","","warning");
                                        }else{
                                            $('#ketqua_follow').html(data);  
                                        }
                                    }   
                                },
                                })
                                .done(function() {
                                    console.log("success");
                                })
                                .fail(function() {
                                    console.log("error");
                                })
                                .always(function() {
                                    console.log("complete");
                            });
                        }
                    </script>
                    <div class="single-post-media">
                        <img src="{{ $urlPic}}" alt="" class="img-fluid">
                    </div><!-- end media -->

                    <div class="blog-content">  
                        <div class="pp">
                            <span style="font-weight: bold">Description:</span> {!! $description !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Job Requirement:</span>{!! $job_requirement !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Benefit:</span> {!! $benefit !!}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Expired Time:</span> <span style="color: red">{{ $expired_time }}</span>
                        </div><!-- end pp -->
                        <hr>
                        <h3>Contact Information</h3>
                         <div class="pp">
                            <span style="font-weight: bold">Fullname:</span> {{ $fullname_contact }}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Phone:</span> {{ $phone_contact }}
                        </div><!-- end pp -->
                        <div class="pp">
                            <span style="font-weight: bold">Email:</span> {{ $email_contact }}
                        </div><!-- end pp -->
                    </div><!-- end content -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">You may also like</h4>
                        <div class="row">
                            @foreach($recruitmentsLQ as $recruitmentLQ)
                            @php
                                $id_lq          = $recruitmentLQ->id_recruitment;
                                $rname_lq       = $recruitmentLQ->rname;
                                $picture_lq     = $recruitmentLQ->picture;
                                $created_at_lq  = $recruitmentLQ->created_at;
                                $cname_lq       = $recruitmentLQ->cname;
                                $status_lq      = $recruitmentLQ->status;

                                $slug_lq   = Str::slug($rname_lq);
                                $urlDetail_lq = route('recruitment.recruitment.detail',[$slug_lq, $id_lq]);

                                $urlPic_lq  = '/storage/app/public/'.$picture_lq;
                            @endphp
                            @if($status_lq == 1)
                                <div class="col-lg-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="{{ $urlDetail_lq}}" title="">
                                                <img src="{{ $urlPic_lq}}" alt="" {{-- class="img-fluid" --}} height="200px">
                                                <div class="hovereffect">
                                                    <span class=""></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <h4><a href="{{ $urlDetail_lq}}" title="">{{ $rname_lq}}</a></h4>
                                            <small><a href="{{ $urlDetail_lq}}" title="">{{ $cname_lq}}</a></small>
                                            <small><a href="{{ $urlDetail_lq}}" title="">{{ $created_at_lq}}</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                            @endif
                            @endforeach

                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">Comment</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-wrapper">
                                    @csrf
                                    <textarea class="form-control" placeholder="Your comment" name="comment"></textarea>
                                    <button type="submit" class="btn btn-success btn-submit">Submit Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                           $(".btn-submit").click(function(e){
                                event.preventDefault();
                                var _token = $("input[name='_token']").val();
                                var comment = $("textarea[name='comment']").val();
                                $("textarea[name='comment']").val('');
                                $.ajax({
                                    url: '{{ route('recruitment.recruitment.comment') }}',
                                    type: 'POST',
                                    data: {
                                        comment:comment,
                                        id_recruitment:{{ $id_recruitment }},
                                        '_token':_token
                                    },
                                    success: function(data){
                                        if (data == 'NOK') {
                                            swal("Please log in","","warning");
                                        }else{
                                           if (data == 'Khoa'){
                                            swal("Your account has been locked out of comments","","warning"); 
                                            }else{
                                                $('#ketqua').html(data);
                                            } 
                                        }
                                    },
                                })
                                .done(function() {
                                  console.log("success");
                                })
                                .fail(function() {
                                  console.log("error");
                                })
                                .always(function() {
                                  console.log("complete");
                                });   
                            });
                        });
                    </script>
                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">Reviews</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list" id="ketqua">
                                    @foreach ($comments as $binhluan)
                                    @php
                                        $comment        = $binhluan->comment;
                                        $status_comment = $binhluan->status_comment;
                                        $fullname       = $binhluan->fullname;
                                    @endphp
                                    @if($status_comment == 1)
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="/public/templates/recruitment/upload/anh2.jpg" alt="" class="rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading user_name">{{ $fullname }}</h4>
                                            <p>{{ $comment }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                    @if(Session::has('msg'))
                        <script type="text/javascript">
                            swal("Submit successful job application","","success");
                        </script>
                    @endif
                    @if(Session::has('mess'))
                        <script type="text/javascript">
                            swal("You are not authorized to perform this function.","","warning");
                        </script>
                    @endif
                    <h2 class="widget-title">Requirement</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <strong>Location:</strong>
                                    <p style="margin-left: 30px;">{{ $address}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    <strong>City:</strong>
                                    <p style="margin-left: 30px;">{{ $city}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-user"></i>
                                    <strong>Job Title:</strong>
                                    <p style="margin-left: 30px;">{{ $cname}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-id-badge"></i>
                                    <strong>Experience:</strong>
                                    <p style="margin-left: 30px;">{{ $experience}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-group"></i>
                                    <strong>Amount:</strong>
                                    <p style="margin-left: 30px;">{{ $amount}} people</p>
                                </li>
                                <li>
                                    <i class="fa fa-blind"></i>
                                    <strong>Gender Requirement:</strong>
                                    <p style="margin-left: 30px;">{{ $gender_requirement}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-money"></i>
                                    <strong>Rate:</strong>
                                    <p style="margin-left: 30px;">{{ $rate}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-cc"></i>
                                    <strong>Type work:</strong>
                                    <p style="margin-left: 30px;">{{ $type_work}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-blind"></i>
                                    <strong>Probationary Period:</strong>
                                    <p style="margin-left: 30px;">{{ $probationary_period}}</p>
                                </li>
                            </ul>
                            <form class="form-wrapper" style="text-align: center" action="{{ route('recruitment.candidate.recruitment',$id_recruitment)}}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary">Apply For This Job</button>
                            </form>
                        </div>
                    </div><!-- end blog-list -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop