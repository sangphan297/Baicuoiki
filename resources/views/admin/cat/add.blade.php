@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Category Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Category Management</h1>
            </header>
            <div class="row">
                <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Category</h4>
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
                    <form class="form-horizontal" method="post" action="{{route('admin.cat.add',['id' => $id])}}">
                        @csrf
                        <div class="row">
                            <label class="col-sm-2 form-control-label">Name</label>
                            <div class="col-sm-10">
                                <div class="form-group-material">
                                    <input id="cname" type="text" name="cname"  class="input-material" >
                                    <label for="cname" class="label-material">Name</label>
                                </div>
                            </div>
                        </div>
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