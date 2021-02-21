<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Models\Recruitment;

class IndexController extends Controller
{
	public function __construct(DataTreeController $cdata_tree, Recruitment $mrecruitment)
	{
    	$this->cdata_tree   = $cdata_tree;
    	$this->mrecruitment = $mrecruitment;
	}

  public function index()
  {
  	$cats                = $this->cdata_tree->cat();
  	$recruitments        = $this->mrecruitment->getRecruitments();
    $recruitmentPopulars = $this->mrecruitment->getRecruitmentPopulars();
   	return view('recruitment.index.index',compact('cats','recruitments','recruitmentPopulars'));
  }

  public function search(Request $request)
  {
    $city                = $request->city;
    $gender_requirement  = $request->gender_requirement;
    $level               = $request->level;
    $experience          = $request->experience;
    $type_work           = $request->type_work;
    $probationary_period = $request->probationary_period;
    $rate                = $request->rate;

    $cats         = $this->cdata_tree->cat();
    $recruitments = $this->mrecruitment->search($city,$gender_requirement,$level,$experience,$type_work,$probationary_period,$rate);
    $count        = $recruitments->count();
    $recruitmentPopulars = $this->mrecruitment->getRecruitmentPopulars();
    return view('recruitment.index.search',compact('cats','recruitments','recruitmentPopulars','count','gender_requirement','level','experience','type_work','probationary_period','rate','city'));
  }

}
