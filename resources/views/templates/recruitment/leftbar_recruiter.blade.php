<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget">
        <h2 class="widget-title">Management Center</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                <ul style="line-height: 3">
                    <li>
                        <i class="fa fa-user"></i>
                        <a href="{{ route('recruitment.recruitment.my_acount',['id_info' => Auth::user()->id_info])}}">Account management</a>
                    </li>
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <a href="{{ route('recruitment.recruiter.publish_recruitment')}}">Published Recruitment</a>
                    </li>
                    <li>
                        <i class="  fa fa-building"></i>
                        <a href="{{ route('recruitment.recruiter.job_listing')}}">Job listing</a>
                    </li>
                    <li>
                        <i class="fa fa-file-archive-o custom"></i>
                        <a href="{{ route('recruitment.recruiter.application_file')}}">Application File</a>
                    </li>
                    <li>
                        <i class="fa fa-file custom"></i>
                        <a href="{{ route('recruitment.recruiter.saved_file')}}">Saved File</a>
                    </li>
                    <li>
                        <i class="fa fa-medkit custom"></i>
                        <a href="{{ route('recruitment.recruiter.transaction_history')}}">Transaction History</a>
                    </li>
                </ul>
            </div>
        </div><!-- end blog-list -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->