@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Comment Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Comment Management</h1>
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
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>News</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $binhluan)
                                        @php
                                            $id_comment = $binhluan->id_comment;
                                            $fullname   = $binhluan->fullname;
                                            $comment    = $binhluan->comment;
                                            $rname      = $binhluan->rname;
                                        @endphp
                                        <tr class="gradeX">
                                            <td>{{ $id_comment }}</td>
                                            <td>{{ $fullname }}</td> 
                                            <td>{{ $comment }}</td> 
                                            <td>{{ $rname }}</td> 
                                            <td class="center">
                                                <a href="{{route('admin.comment.del',$id_comment)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Deleted</a>
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