<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\Recruiter;
use App\Models\Candidate;

class AdminController extends Controller
{
	public function __construct(Recruitment $mrecruitment, Recruiter $mrecruiter, Candidate $mcandidate)
	{
        $this->mrecruitment = $mrecruitment;
        $this->mrecruiter   = $mrecruiter;
        $this->mcandidate   = $mcandidate;
	}
    public function index()
    {
    	$recruitments      = $this->mrecruitment->getAllRecruitments();
    	$count_recruitment = $recruitments->count();

    	$recruiters      = $this->mrecruiter->getAllRecruiters();
    	$count_recruiter = $recruiters->count();

    	$candidates       = $this->mcandidate->getAllCandidates();
    	$count_candidate  = $candidates->count();
    	return view('admin.admin.index',compact('count_recruitment','count_recruiter','count_candidate'));
    }
}
