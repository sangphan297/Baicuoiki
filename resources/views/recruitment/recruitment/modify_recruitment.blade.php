@extends('templates.recruitment.master')
@section('main-content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <h3>Modify Recruitment</h3>
                    <hr class="invis1">
                    @if(Session::has('msg'))
                        <script type="text/javascript">
                            swal("Updated successful","","success");
                        </script>
                    @endif
                    
                    <div class="blog-content">
                        <form action="{{ route('recruitment.recruiter.modify_recruitment', $recruitment->id_recruitment)}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title:</label>
                                <input type="text" class="form-control" name="rname" value="{{$recruitment->rname}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Number to be recruited:</label>
                                <input type="text" class="form-control" name="amount" value="{{$recruitment->amount}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Expired time:</label>
                                <input type="text" class="form-control" name="expired_time" value="{{$recruitment->expired_time}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender requirement:</label>
                                <select name="gender_requirement" class="form-group-material">
                                    @if($recruitment->gender_requirement == "Male")
                                        <option value="Male" selected="">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->gender_requirement == "Female")
                                        <option value="Male">Male</option>
                                        <option value="Female" selected="">Female</option>
                                        <option value="Not required">Not required</option>
                                    @else
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Not required" selected="">Not required</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Position:</label>
                                <select name="id_cat" class="form-group-material">
                                    @foreach($positions as $position)
                                    @php
                                        $id_cat = $position->id_cat;
                                        $cname  = $position->cname;
                                        $selected = '';
                                        if ($id_cat == $recruitment->id_cat) {
                                           $selected = 'selected=""';
                                        }
                                    @endphp
                                        <option value="{{ $id_cat }}" {{ $selected }}>{{ $cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Description:</p>
                                <textarea class="form-group" name="description" required cols="50" rows="5">{!! $recruitment->description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <p>Job requirements:</p>
                                <textarea class="form-group" name="job_requirement" required cols="50" rows="5">{!! $recruitment->job_requirement !!}</textarea>
                            </div>
                            <div class="form-group">
                                <p>Benefit:</p>
                                <textarea class="form-group" name="benefit" required cols="50" rows="5">{!! $recruitment->benefit !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Level:</label>
                                <select name="level" class="form-group-material">
                                    @if($recruitment->level == "University")
                                        <option value="University" selected="">University</option>
                                        <option value="Colleges">Colleges</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->level == "Colleges")
                                        <option value="University">University</option>
                                        <option value="Colleges" selected="">Colleges</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->level == "Intermediate")
                                        <option value="University">University</option>
                                        <option value="Colleges">Colleges</option>
                                        <option value="Intermediate" selected="">Intermediate</option>
                                        <option value="Not required">Not required</option>
                                    @else
                                        <option value="University">University</option>
                                        <option value="Colleges">Colleges</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Not required" selected="">Not required</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Experience:</label>
                                <select name="experience" class="form-group-material">
                                    @if($recruitment->experience == "1 year")
                                        <option value="1 year" selected="">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="Over 3 years">Over 3 years</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->experience == "2 years")
                                        <option value="1 year">1 year</option>
                                        <option value="2 years" selected="">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="Over 3 years">Over 3 years</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->experience == "3 years")
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years" selected="">3 years</option>
                                        <option value="Over 3 years">Over 3 years</option>
                                        <option value="Not required">Not required</option>
                                    @elseif($recruitment->experience == "Over 3 years")
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="Over 3 years" selected="">Over 3 years</option>
                                        <option value="Not required">Not required</option>
                                    @else
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="Over 3 years">Over 3 years</option>
                                        <option value="Not required" selected="">Not required</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Form of work:</label>
                                <select name="type_work" class="form-group-material">
                                    @if($recruitment->type_work == "Full-time")
                                        <option value="Full-time" selected="">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Intership">Intership</option>
                                    @elseif($recruitment->type_work == "Part-time")
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time" selected="">Part-time</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Intership">Intership</option>
                                    @elseif($recruitment->type_work == "Freelance")
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Freelance" selected="">Freelance</option>
                                        <option value="Intership">Intership</option>
                                    @else
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Intership" selected="">Intership</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Probationary period:</label>
                                <select name="probationary_period" class="form-group-material">
                                    @if($recruitment->probationary_period == "Get this job now")
                                        <option value="Get this job now" selected="">Get this job now</option>
                                        <option value="1 month">1 month</option>
                                        <option value="2 months">2 months</option>
                                        <option value="3 months">3 months</option>
                                        <option value="Exchange through the interview">Exchange through the interview</option>
                                    @elseif($recruitment->probationary_period == "1 month")
                                        <option value="Get this job now">Get this job now</option>
                                        <option value="1 month" selected="">1 month</option>
                                        <option value="2 months">2 months</option>
                                        <option value="3 months">3 months</option>
                                        <option value="Exchange through the interview">Exchange through the interview</option>
                                    @elseif($recruitment->probationary_period == "2 months")
                                        <option value="Get this job now">Get this job now</option>
                                        <option value="1 month">1 month</option>
                                        <option value="2 months" selected="">2 months</option>
                                        <option value="3 months">3 months</option>
                                        <option value="Exchange through the interview">Exchange through the interview</option>
                                    @elseif($recruitment->probationary_period == "3 months")
                                        <option value="Get this job now">Get this job now</option>
                                        <option value="1 month">1 month</option>
                                        <option value="2 months">2 months</option>
                                        <option value="3 months" selected="">3 months</option>
                                        <option value="Exchange through the interview">Exchange through the interview</option>
                                    @else
                                        <option value="Get this job now">Get this job now</option>
                                        <option value="1 month">1 month</option>
                                        <option value="2 months">2 months</option>
                                        <option value="3 months">3 months</option>
                                        <option value="Exchange through the interview" selected="">Exchange through the interview</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rate:</label>
                                <select name="rate" class="form-group-material">
                                     @if($recruitment->rate == "200-300$")
                                        <option value="200-300$" selected="">200-300$</option>
                                        <option value="300-500$">300-500$</option>
                                        <option value="500-1000$">500-1000$</option>
                                        <option value="Over 1000$">Over 1000$</option>
                                    @elseif($recruitment->rate == "300-500$")
                                        <option value="200-300$">200-300$</option>
                                        <option value="300-500$" selected="">300-500$</option>
                                        <option value="500-1000$">500-1000$</option>
                                        <option value="Over 1000$">Over 1000$</option>
                                    @elseif($recruitment->rate == "500-1000$")
                                        <option value="200-300$">200-300$</option>
                                        <option value="300-500$">300-500$</option>
                                        <option value="500-1000$" selected="">500-1000$</option>
                                        <option value="Over 1000$">Over 1000$</option>
                                    @else
                                        <option value="200-300$">200-300$</option>
                                        <option value="300-500$">300-500$</option>
                                        <option value="500-1000$">500-1000$</option>
                                        <option value="Over 1000$" selected="">Over 1000$</option>
                                    @endif
                                </select>
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
                            <button type="submit" class="btn btn-primary">Modify Recruitment</button>
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