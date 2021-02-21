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
                    <h3>Recharge</h3>
                    <hr class="invis1">
                    <div class="blog-content">
                            <div class="table-responsive">
                                <form action="{{ route('recruitment.recruiter.recharge')}}" id="create_form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="language">Commodities</label>
                                        <select name="order_type" id="order_type" class="form-control">
                                            <option value="other">Deposit Account</option>
                                            <option value="topup">Top-up phone</option>
                                            <option value="billpayment">Pay the bill</option>
                                            <option value="fashion">Fashion</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_id">Code Bill</label>
                                        <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount of money</label>
                                        <input class="form-control" id="amount"
                                               name="amount" type="number" value="10000"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_desc">Content Billing</label>
                                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Content Billing</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_code">Bank</label>
                                        <select name="bank_code" id="bank_code" class="form-control">
                                            <option value="">Not selected</option>
                                            <option value="NCB"> Ngan hang NCB</option>
                                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                                            <option value="SCB"> Ngan hang SCB</option>
                                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                                            <option value="MSBANK"> Ngan hang MSBANK</option>
                                            <option value="NAMABANK"> Ngan hang NamABank</option>
                                            <option value="VNMART"> Vi dien tu VnMart</option>
                                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                            <option value="HDBANK">Ngan hang HDBank</option>
                                            <option value="DONGABANK"> Ngan hang Dong A</option>
                                            <option value="TPBANK"> Ngân hàng TPBank</option>
                                            <option value="OJB"> Ngân hàng OceanBank</option>
                                            <option value="BIDV"> Ngân hàng BIDV</option>
                                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                            <option value="VPBANK"> Ngan hang VPBank</option>
                                            <option value="MBBANK"> Ngan hang MBBank</option>
                                            <option value="ACB"> Ngan hang ACB</option>
                                            <option value="OCB"> Ngan hang OCB</option>
                                            <option value="IVB"> Ngan hang IVB</option>
                                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <select name="language" id="language" class="form-control">
                                            <option value="vn">Vietnamese</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>

                                    {{-- <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán</button> --}}
                                    <button type="submit" class="btn btn-default">Pay</button>
                                </form>
                                <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
                                <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
                                <script type="text/javascript">
                                    $("#btnPopup").click(function () {
                                        var postData = $("#create_form").serialize();
                                        var submitUrl = $("#create_form").attr("action");
                                        $.ajax({
                                            type: "POST",
                                            url: submitUrl,
                                            data: postData,
                                            dataType: 'JSON',
                                            success: function (x) {
                                                if (x.code === '00') {
                                                    if (window.vnpay) {
                                                        vnpay.open({width: 768, height: 600, url: x.data});
                                                    } else {
                                                        location.href = x.data;
                                                    }
                                                    return false;
                                                } else {
                                                    alert(x.Message);
                                                }
                                            }
                                        });
                                        return false;
                                    });
                                </script>
                            </div>
                    </div><!-- end content -->

                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop