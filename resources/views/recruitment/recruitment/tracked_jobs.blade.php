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
</div><!-- end page-title <--></-->
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <h3>Tracked Jobs</h3>
                    <hr class="invis1">
                    @if(Session::get('msg') == "Deleted successfully.")
                        <script type="text/javascript">
                            swal("Deleted successfully","","success");
                        </script>
                    @elseif(Session::get('msg') == "Downloaded successfully.")
                        <script type="text/javascript">
                            swal("Downloaded successfully","","success");
                        </script>
                    @endif
                    <div class="blog-content">
                        <form action="{{ route('recruitment.candidate.tracked_jobs')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Title</th>
                                    <th>Position</th>
                                    <th>Track Date</th>
                                    <th>Detail</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($follows as $follow)
                                    @php
                                        $id_recruitment   = $follow->id_recruitment;
                                        $position         = $follow->cname;
                                        $rname            = $follow->rname;
                                        $track_date       = $follow->track_date;

                                        $slug      = Str::slug($rname);
                                        $urlDetail = route('recruitment.recruitment.detail',[$slug, $id_recruitment]);
                                    @endphp
                                    <tr>    
                                        <td>{{ $rname }}</td>
                                        <td>{{ $position }}</td>
                                        <td>{{ $track_date}}</td>
                                        <td><a href="{{ $urlDetail }}" style="color: green">Detail</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
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