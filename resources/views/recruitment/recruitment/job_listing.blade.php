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
                    <h3>Job Listing</h3>
                    <form action="{{ route('recruitment.recruiter.export_recruitment')}}" method="get" style="margin-left: 650px; margin-top: -60px;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Export Excel</button>
                    </form>
                    <hr class="invis1">
                    @if(Session::get('msg') == "Deleted successfully.")
                        <script type="text/javascript">
                            swal("Deleted successful","","success");
                        </script>
                    @elseif(Session::get('msg') == "More success.")
                        <script type="text/javascript">
                            swal("Published successful","","success");
                        </script>
                    @endif
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.job_listing')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Tiltle</th>
                                    <th>Amount</th>
                                    <th>Expired Time</th>
                                    <th>Application Count</th>
                                    <th>Status</th>
                                    <th>Function</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($arResutls as $arResutl)
                                    @php
                                        $id_recruitment     = $arResutl['id_recruitment'];
                                        $rname              = $arResutl['rname'];
                                        $amount             = $arResutl['amount'];
                                        $expired_time       = $arResutl['expired_time'];
                                        $application_number = $arResutl['application_number'];
                                        $name_status        = $arResutl['name_status'];
                                    @endphp
                                    <tr>
                                        <td>{{ $rname }}</td>
                                        <td style="text-align: center">{{ $amount }}</td>
                                        <td>{{ $expired_time }}</td>
                                        <td style="text-align: center">{{ $application_number }}</td>
                                        @if( $name_status == 'Expired')
                                            <td style="color: red">{{ $name_status }}</td>
                                        @else
                                            <td style="color: green">{{ $name_status }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('recruitment.recruiter.preview_recruitment',$id_recruitment)}}">Preview</a>||<a href="{{ route('recruitment.recruiter.modify_recruitment',$id_recruitment)}}">Modify</a>||<a href="{{ route('recruitment.recruiter.del_recruitment',$id_recruitment)}}">Delete</a>  
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                        </form>  
                    </div><!-- end content -->
                    {!! $job_listings ->links() !!}
                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop