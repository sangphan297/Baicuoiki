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
                    <h3>Transaction History</h3>
                    <hr class="invis1">
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.transaction_history')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Date of Filing</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    @php
                                        $id_payment     = $payment->id_payment;
                                        $amount         = $payment->amount;
                                        $date_of_filing = $payment->date_of_filing;
                                    @endphp
                                    <tr>
                                        <td>{{ $id_payment }}</td> 
                                        <td>{{ number_format($amount) }} VNĐ</td> 
                                        <td>{{ $date_of_filing }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                        </form>  
                        <div>
                            <p><span style="font-weight: bold; font-size: 20px;">Totals:</span>  <span style="color: red;font-weight: bold;font-size: 20px;">{{ number_format($total) }} VNĐ</span></p>
                        </div>
                    </div><!-- end content -->
                    {!! $payments->links() !!}
                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop