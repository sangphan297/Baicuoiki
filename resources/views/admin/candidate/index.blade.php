@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Candidate Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Candidate Management</h1>
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
                                            <th>Email</th>
                                            <th>Fullname</th>
                                            <th>Role</th>
                                            <th>Status Comment</th>
                                            <th>Active</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($users as $user)
                                        @php
                                            $id_user        = $user->id_user;
                                            $email          = $user->email;
                                            $fullname       = $user->fullname;
                                            $id_info        = $user->id_info;
                                            $active         = $user->active;
                                            $status_comment = $user->status_comment;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $id_user }}</th>
                                            <td>{{ $email }}</td> 
                                            <td>{{ $fullname }}</td> 
                                            <td>
                                                Candidate
                                            </td>
                                            <td id="kq-{{ $id_user }}">
                                                <form>
                                                @csrf
                                                @if($status_comment == 1)
                                                    <center><a href="javascript:void(0)" onclick="changeStatus({{ $id_user }},{{ $status_comment }})"
                                                        style="color: green;">Lock<a/></center>
                                                @else
                                                    <center><a href="javascript:void(0)" style="color: red;" onclick="changeStatus({{ $id_user }},{{ $status_comment }})">Unlock</a></center>
                                                @endif
                                                </form>
                                            </td>
                                            <td id="result-{{ $id_user }}">
                                                <form>
                                                @csrf
                                                @if($active == 1)
                                                    <center><a href="javascript:void(0)" onclick="getInfo({{ $id_user }},{{ $active }})"><img src="{{ $adminUrl }}/img/1.png" alt="" width="20px"  height="20px"></a></center>
                                                @elseif($active == 0)
                                                    <center><a href="javascript:void(0)" onclick="getInfo({{ $id_user }},{{ $active }})"><img src="{{ $adminUrl }}/img/0.jpg" alt="" width="20px"  height="20px"></a></center>
                                                @endif
                                                </form>
                                            </td>
                                            <td width="100px">
                                                <a href="{{route('admin.candidate.del', $id_user)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <script type="text/javascript">
                                            function changeStatus(id_user ,status_comment) {
                                                var _token = $('input[name=_token]').val();
                                                $.ajax({
                                                    url: '{{ route('admin.candidate.method') }}',
                                                    type: 'POST',
                                                    data: {
                                                        id_user:id_user,
                                                        status_comment:status_comment,
                                                        '_token':_token
                                                    },
                                                    success: function(data){
                                                        var id_td1 ='#kq-'+id_user;
                                                        $(id_td1).html(data);       
                                                    },
                                                    })
                                                    .done(function() {
                                                        console.log("success");
                                                    })
                                                    .fail(function() {
                                                        console.log("error");
                                                    })
                                                    .always(function() {
                                                        console.log("complete");
                                                });
                                            }

                                            function getInfo(id_user ,active) {
                                                var _token = $('input[name=_token]').val();
                                                $.ajax({
                                                    url: '{{ route('admin.candidate.index') }}',
                                                    type: 'POST',
                                                    data: {
                                                        id_user:id_user,
                                                        active:active,
                                                        '_token':_token
                                                    },
                                                    success: function(data){
                                                        var id_td ='#result-'+id_user;
                                                        $(id_td).html(data);       
                                                    },
                                                    })
                                                    .done(function() {
                                                        console.log("success");
                                                    })
                                                    .fail(function() {
                                                        console.log("error");
                                                    })
                                                    .always(function() {
                                                        console.log("complete");
                                                });
                                            }
                                            
                                        </script>
                                    </tbody>
                                </table>
                          </div>
                          {!! $users->links() !!}
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    @include('templates.admin.footer')
</div>
@stop