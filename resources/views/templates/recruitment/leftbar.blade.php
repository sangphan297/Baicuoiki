<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget">
            <h2 class="widget-title">Job Seeking</h2>
            <div class="blog-list-widget">
                <div class="list-group">
                    <form action="{{ route('recruitment.index.search')}}" method="get">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="city" value="" placeholder="City">
                            <select name="gender_requirement" class="custom-select">
                                <option value="">Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Not required">Not required</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="level" class="custom-select">
                                <option value="">Level</option>
                                <option value="University">University</option>
                                <option value="Colleges">Colleges</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Not required">Not required</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="experience" class="custom-select">
                                <option value="">Experience</option>
                                <option value="1 year">1 year</option>
                                <option value="2 years">2 years</option>
                                <option value="3 years">3 years</option>
                                <option value="Over 2 years">Over 3 years</option>
                                <option value="Not required">Not required</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="type_work" class="custom-select">
                                <option value="">Type Work</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Intership">Intership</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="probationary_period" class="custom-select">
                                <option value="">Probationary Period</option>
                                <option value="Get this job now">Get this job now</option>
                                <option value="1 month">1 month</option>
                                <option value="2 months">2 months</option>
                                <option value="3 months">3 months</option>
                                <option value="Exchange through the interview">Exchange through the interview</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="rate" class="custom-select">
                                <option value="">Rate</option>
                                <option value="200-300$">200-300$</option>
                                <option value="300-500$">300-500$</option>
                                <option value="500-1000$">500-1000$</option>
                                <option value="Over 1000$">Over 1000$</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form> 
                </div>
            </div><!-- end blog-list -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->