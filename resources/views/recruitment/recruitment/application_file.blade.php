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
                    <h3>Application File</h3>
                    <hr class="invis1">
                    @if(Session::get('msg') == "Deleted successfully.")
                        <script type="text/javascript">
                            swal("Deleted successfully","","success");
                        </script>
                    @elseif(Session::get('msg') == "Downloaded successfully.")
                        <script type="text/javascript">
                            swal("Downloaded successfully","","success");
                        </script>
                    @elseif(Session::get('msg') == "Saved successfully.")
                        <script type="text/javascript">
                            swal("Saved successfully","","success");
                        </script>
                    @elseif(Session::get('msg') == "Unsaved successfully.")
                        <script type="text/javascript">
                            swal("Unsaved successfully","","success");
                        </script>
                    @endif
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.application_file')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Tiltle</th>
                                    <th>Position</th>
                                    <th>Application Date</th>
                                    <th>Fullname</th>
                                    <th>CV</th>
                                    <th>Status</th>
                                    <th>Function</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($applys as $apply)
                                    @php
                                        $id_apply         = $apply->id_apply;
                                        $fullname         = $apply->fullname;
                                        $rname            = $apply->rname;
                                        $cname            = $apply->cname;
                                        $cv               = $apply->cv;
                                        $status_save      = $apply->status_save;
                                        $application_date = $apply->application_date;

                                        $urlCv = '/storage/app/files/'.$cv;
                                    @endphp
                                    <tr>
                                        <td>{{ $rname }}</td>
                                        <td>{{ $cname }}</td>
                                        <td>{{ $application_date }}</td>
                                        <td>{{ $fullname }}</td>
                                        <td>{{-- <a href="{{route('recruitment.recruiter.download_cv',$id_apply)}}" title="" style="color: green"> Download</a> --}}
                                            <a href="{{ $urlCv }}" style="color: green">Link</a></td>
                                        @if($status_save == '0')
                                            <td style="color: red">Not saved</td>
                                            <td>
                                            <a href="{{ route('recruitment.recruiter.save_apply',$id_apply)}}">Save</a>||<a href="{{ route('recruitment.recruiter.del_apply',$id_apply)}}">Delete</a>  
                                        </td>
                                        @else
                                            <td style="color: green">Saved</td>
                                            <td>
                                            <a href="{{ route('recruitment.recruiter.save_apply',$id_apply)}}">Unsaved</a>||<a href="{{ route('recruitment.recruiter.del_apply',$id_apply)}}">Delete</a>  
                                        </td>
                                        @endif
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

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop