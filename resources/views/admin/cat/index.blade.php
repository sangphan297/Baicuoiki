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
            @if (Session::has('msg'))
                <p style="color: red;">{{ Session::get('msg') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.cat.add')}}" class="btn btn-success btn-md">Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($arResults as $key => $arResult)
                                        @php
                                            $arCats    = $arResult;
                                            $arKey    = explode('-', $key);
                                            $id_cat   = $arKey['1'];
                                            $cname    = $arKey['0'];
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $id_cat }}</th>
                                            <td>{{ $cname }}<a href="{{route('admin.cat.add',['id' => $id_cat])}}" title="" ><i class="fa fa-add "></i> Add</a>
                                            @foreach($arCats as $arCat)
                                               @php
                                                    $id = $arCat['id_cat'];
                                               @endphp
                                                <div>
                                                    @php
                                                        echo str_repeat('---', $arCat['level']).$arCat['cname'];
                                                    @endphp
                                                    <a href="{{route('admin.cat.edit',$id)}}" title="" ><i class="fa fa-edit "></i> Edit</a>
                                                    <a href="{{route('admin.cat.del',$id)}}" title="" ><i class="fa fa-pencil"></i> Delete</a>
                                                </div>
                                            @endforeach
                                            <td width="200px">
                                                <a href="{{route('admin.cat.edit',$id_cat)}}" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Edit</a>
                                                <a href="{{route('admin.cat.del',$id_cat)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</a>
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