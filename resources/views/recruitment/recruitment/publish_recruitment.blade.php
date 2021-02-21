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
                    <h3>Published Recruitment</h3>
                    <hr class="invis1">
                    @if(Session::has('msg'))
                        <script type="text/javascript">
                            swal("Not enough money. Please recharge.","","warning");
                        </script>
                    @endif
                    
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.publish_recruitment')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title:</label>
                                <input type="text" class="form-control" name="rname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Number to be recruited:</label>
                                <input type="text" class="form-control" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Expired time:</label>
                                <input type="text" class="form-control" name="expired_time">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Picture:</label>
                                <input type="file" class="form-control" name="picture">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender requirement:</label>
                                <select name="gender_requirement" class="form-group-material">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Not required">Not required</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Position:</label>
                                <select name="id_cat" class="form-group-material">
                                    @foreach($positions as $position)
                                    @php
                                        $id_cat = $position->id_cat;
                                        $cname  = $position->cname;
                                    @endphp
                                        <option value="{{ $id_cat }}">{{ $cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Description:</p>
                                <textarea class="form-group" name="description" required cols="50" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <p>Job requirements:</p>
                                <textarea class="form-group" name="job_requirement" required cols="50" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <p>Benefit:</p>
                                <textarea class="form-group" name="benefit" required cols="50" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Level:</label>
                                <select name="level" class="form-group-material">
                                    <option value="University">University</option>
                                    <option value="Colleges">Colleges</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Not required">Not required</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Experience:</label>
                                <select name="experience" class="form-group-material">
                                    <option value="1 year">1 year</option>
                                    <option value="2 years">2 years</option>
                                    <option value="3 years">3 years</option>
                                    <option value="Over 2 years">Over 3 years</option>
                                    <option value="Not required">Not required</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Form of work:</label>
                                <select name="type_work" class="form-group-material">
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Intership">Intership</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Probationary period:</label>
                                <select name="probationary_period" class="form-group-material">
                                    <option value="Get this job now">Get this job now</option>
                                    <option value="1 month">1 month</option>
                                    <option value="2 months">2 months</option>
                                    <option value="3 months">3 months</option>
                                    <option value="Exchange through the interview">Exchange through the interview</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rate:</label>
                                <select name="rate" class="form-group-material">
                                    <option value="200-300$">200-300$</option>
                                    <option value="300-500$">300-500$</option>
                                    <option value="500-1000$">500-1000$</option>
                                    <option value="Over 1000$">Over 1000$</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type of news:</label>
                                <select name="type_new" class="form-group-material">
                                    <option value="pending">Pending</option>
                                    <option value="direct">Direct</option>
                                </select>
                            </div>
                            <hr>
                            <h3>Company information</h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company name: <span style="font-weight: bold">{{ $user->company_name }}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address:</label>
                                <input type="text" class="form-control" value="{{ $user->address }}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City:</label>
                                <input type="text" class="form-control" value="{{ $user->city }}" name="city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Scope of Work:</label>
                                <select name="id_cat" class="form-group-material">
                                    @foreach($type_works as $type_work)
                                    @php
                                        $id_cat = $type_work->id_cat;
                                        $cname  = $type_work->cname;
                                        $selected = '';
                                    @endphp
                                    @if($id_cat == $user->id_cat)
                                        @php
                                            $selected ='selected ="selected"';
                                        @endphp
                                    @endif
                                    <option value="{{ $id_cat }}" {{ $selected }}>{{ $cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Company profile:</p>
                                <textarea class="form-group-material" name="company_profile" required cols="50" rows="5">{{ $user->company_profile }}</textarea>
                            </div>
                            <hr>
                            <h3>Contact information</h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fullname:</label>
                                <input type="text" class="form-control" value="{{ $user->fullname_contact }}" name="fullname_contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->phone_contact }}" name="phone_contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email_contact }}" name="email_contact">
                            </div>
                            <button type="submit" class="btn btn-primary">Published Recruitment</button>
                        </form>  
                    </div><!-- end content -->

                    <hr class="invis1">
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            @include('templates.recruitment.leftbar_recruiter')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop