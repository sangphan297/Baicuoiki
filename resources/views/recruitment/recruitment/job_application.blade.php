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
</div><!-- end page-title -->
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <h3>Job Application</h3>
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
                        <form action="{{ route('recruitment.candidate.job_application')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Position</th>
                                    <th>Company</th>
                                    <th>Application Date</th>
                                    <th>Profile Submitted</th>
                                    <th>Status</th>
                                    <th>Function</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($applys as $apply)
                                    @php
                                        $id_apply         = $apply->id_apply;
                                        $position         = $apply->cname;
                                        $application_date = $apply->application_date;
                                        $company_name     = $apply->company_name;
                                        $cv               = $apply->cv;

                                        $urlCv = '/storage/app/files/'.$cv;
                                    @endphp
                                    <tr>
                                        <td>{{ $position }}</td>
                                        <td>{{ $company_name }}</td>
                                        <td>{{ $application_date}}</td>
                                        {{-- <td><a href="{{route('recruitment.candidate.download_cv',$id_apply)}}" title="" style="color: green"> Download</a></td> --}}
                                        <td><a href="{{ $urlCv }}" style="color: green">Link</a></td>
                                        <td>Sent successfully</td>
                                        <td>
                                            <a href="{{ route('recruitment.candidate.del_apply',$id_apply)}}">Delete</a> 
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                        </form>  
                    </div><!-- end content -->
                    {!! $applys ->links() !!}
                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_candidate')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop