@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Payment Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Payment Management</h1>
            </header>
            @if (Session::has('msg'))
                <p style="color: red;">{{ Session::get('msg') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Recruiter</th>
                                            <th>Amount</th>
                                            <th>Date of Filing</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        @php
                                            $id_payment     = $payment->id_payment;
                                            $company_name   = $payment->company_name;
                                            $amount         = $payment->amount;
                                            $date_of_filing = $payment->date_of_filing;
                                        @endphp
                                        <tr class="gradeX">
                                            <td>{{ $id_payment }}</td>
                                            <td>{{ $company_name }}</td> 
                                            <td>{{ number_format($amount) }} VNĐ</td> 
                                            <td>{{ $date_of_filing }}</td> 
                                            <td class="center">
                                                <a href="{{route('admin.payment.del',$id_payment)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Deleted</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                          </div>
                          <div>
                              <p><span style="font-weight: bold; font-size: 20px;">Totals:</span>  <span style="color: red;font-weight: bold;font-size: 20px;">{{ number_format($total) }} VNĐ</span></p>
                          </div>
                          {!! $payments->links() !!}
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    @include('templates.admin.footer')
</div>
@stop