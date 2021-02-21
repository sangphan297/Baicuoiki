@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">User Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">User Management</h1>
            </header>
            @if (Session::has('msg'))
                <p style="color: red;">{{ Session::get('msg') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add User</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="{{route('admin.user.add')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-10">
                                <div class="form-group-material">
                                    <input id="Email" type="email" name="email"  class="input-material" >
                                    <label for="Email" class="label-material">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="row">
                            <label class="col-sm-2 form-control-label">Password</label>
                            <div class="col-sm-10">
                                <div class="form-group-material">
                                    <input id="Password" type="password" name="password"  class="input-material" >
                                    <label for="Password" class="label-material">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="row">
                            <label class="col-sm-2 form-control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <div class="form-group-material">
                                    <input id="ConfirmPassword" type="password" name="password_confirm"  class="input-material" >
                                    <label for="ConfirmPassword" class="label-material">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                       {{--  <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Jurisdiction</label>
                            <div class="col-sm-10 mb-3">
                                <select name="phanquyen" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="mod">Mod</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="line"></div>
                        <div class="row">
                            <label class="col-sm-2 form-control-label">Fullname</label>
                            <div class="col-sm-10">
                                <div class="form-group-material">
                                    <input id="Fullname" type="text" name="fullname"  class="input-material" >
                                    <label for="Fullname" class="label-material">Fullname</label>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 offset-sm-2">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add">
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
              </div>
            </div>
          </section>
    @include('templates.admin.footer')
</div>
@stop