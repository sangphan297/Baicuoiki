@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Contact Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Contact Management</h1>
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
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                        @php
                                            $id_contact = $contact->id_contact;
                                            $name       = $contact->name;
                                            $phone      = $contact->phone;
                                            $email      = $contact->email;
                                            $subject    = $contact->subject;
                                            $message    = $contact->message;
                                        @endphp
                                        <tr class="gradeX">
                                            <td>{{ $id_contact }}</td>
                                            <td>{{ $name }}</td> 
                                            <td>{{ $phone }}</td> 
                                            <td>{{ $email }}</td> 
                                            <td>{{ $subject }}</td> 
                                            <td>{{ $message }}</td> 
                                            <td class="center">
                                                <a href="{{route('admin.contact.del',$id_contact)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Deleted</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    @include('templates.admin.footer')
</div>
@stop