@extends('templates.recruitment.master')
@section('main-content')
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <h2 style="text-align: center;">Apply For This Job</h2>
                    <div class="row">
                        <div class="col-lg-12">  
                            <h3 style="text-align: center">You have already filed for this position on {{ $application_date }}</h3>
                            <h3 style="text-align: center">Would you like to reapply?</h3>
                            <form class="form-wrapper" action="{{ route('recruitment.candidate.resubmit',$id_recruitment)}}" method="post" style="text-align: center">
                                @csrf
                                <button type="submit" class="btn btn-primary" name="submit" value="yes">Yes<i class="fa fa-envelope-open-o"></i></button>
                                <button type="submit" class="btn btn-primary" name="submit" value="no">No<i class="fa fa-envelope-open-o"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@stop