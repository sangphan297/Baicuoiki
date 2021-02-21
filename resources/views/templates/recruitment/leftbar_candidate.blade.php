<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget">
        <h2 class="widget-title">Management Center</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                <ul style="line-height: 3">
                    <li>
                        <i class="fa fa-user"></i>
                        <a href="{{ route('recruitment.recruitment.my_acount',['id_info' => $user->id_info])}}">Account management</a>
                    </li>
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <a href="{{ route('recruitment.candidate.job_application')}}">Job application</a>
                    </li>
                    <li>
                         <i class="fa fa-building"></i>
                        <a href="{{ route('recruitment.candidate.tracked_jobs')}}">Tracked Jobs</a>
                    </li>
                </ul>
            </div>
        </div><!-- end blog-list -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->