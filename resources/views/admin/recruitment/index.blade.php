@extends('templates.admin.master')
@section('main-content')
<div class="page">
    @include('templates.admin.header')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item status">News Recruitment Management</li>
          </ul>
        </div>
    </div>
    <section>
        <div class="container-fluid">
              <!-- Page Header-->
            <header> 
                <h1 class="h3 display">News Recruitment Management</h1>
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
                                            <th>Position</th>
                                            <th>Rate</th>
                                            <th>Address</th>
                                            <th>Author</th>
                                            <th>Type Work</th>
                                            <th>Picture</th>
                                            <th>Status</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recruitments as $recruitment)
                                        @php
                                            $id_recruitment = $recruitment->id_recruitment;
                                            $rname          = $recruitment->rname;
                                            $cname          = $recruitment->cname;
                                            $type_work      = $recruitment->type_work;
                                            $fullname       = $recruitment->fullname;
                                            $rate           = $recruitment->rate;
                                            $address        = $recruitment->address;
                                            $picture        = $recruitment->picture;
                                            $status         = $recruitment->status;

                                            $slug      = Str::slug($rname);
                                            $urlDetail = route('recruitment.recruitment.detail',[$slug, $id_recruitment]);
                                            $urlPic = '/storage/app/public/'.$picture;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $id_recruitment }}</th>
                                            <td>{{ $rname }}</td>
                                            <td>{{ $cname }}</td>
                                            <td>{{ $rate }}</td>
                                            <td>{{ $address }}</td>
                                            <td>{{ $fullname }}</td>
                                            <td>{{ $type_work }}</td>
                                            <td class="center">
                                                <img src="{{ $urlPic }}" alt="" height="100px" width="100px" />
                                            </td> 
                                            <td id="result-{{ $id_recruitment }}">
                                                <form>
                                                @csrf
                                                @if($status == 1)
                                                    <center><a href="javascript:void(0)" onclick="getInfo({{ $id_recruitment }},{{ $status }})"><img src="{{ $adminUrl }}/img/1.png" alt="" width="20px"  height="20px"></a></center>
                                                @elseif($status == 2)
                                                    <center><a href="javascript:void(0)" onclick="getInfo({{ $id_recruitment }},{{ $status }})">Chờ phê duyệt</a></center>
                                                @elseif($status == 0)
                                                    <center><a href="javascript:void(0)" onclick="getInfo({{ $id_recruitment }},{{ $status }})"><img src="{{ $adminUrl }}/img/0.jpg" alt="" width="20px"  height="20px"></a></center>
                                                @endif
                                                </form>
                                            </td>
                                            <td width="100px">  
                                                <a href="{{route('admin.recruitment.del', $id_recruitment)}}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                         <script type="text/javascript">
                                            function getInfo(id_recruitment ,status) {
                                                var _token = $('input[name=_token]').val();
                                                $.ajax({
                                                    url: '{{ route('admin.recruitment.index') }}',
                                                    type: 'POST',
                                                    data: {
                                                        id_recruitment:id_recruitment,
                                                        status:status,
                                                        '_token':_token
                                                    },
                                                    success: function(data){
                                                        if (data == "NOK") {
                                                            swal("Bạn không có quyền thực hiện chức năng này","","warning");
                                                        }else{
                                                            var id_td ='#result-'+id_recruitment;
                                                            $(id_td).html(data);
                                                        }     
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
                          {!! $recruitments->links() !!}
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    @include('templates.admin.footer')
</div>
@stop