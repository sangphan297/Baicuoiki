<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Recruitment;
use App\Models\Apply;
use App\Models\User;
use App\Models\FollowRecruitment;

use Auth;
use Carbon\Carbon;
use Session;
use DateTime;
use Str;
use Response;

class CandidateController extends Controller
{
	public function __construct(DataTreeController $cdata_tree, Candidate $mcandidate, Recruitment $mrecruitment, Apply $mapply, User $muser, FollowRecruitment $mfollow)
	{
    	$this->cdata_tree   = $cdata_tree;
    	$this->mcandidate   = $mcandidate;
      $this->mrecruitment = $mrecruitment;
      $this->mapply       = $mapply;
      $this->muser        = $muser;
      $this->mfollow      = $mfollow;
	}

  public function postUpdate_candidate(Request $request,$id)
  {
    $id_info       = $request->id_info;
    $fullname      = $request->fullname;
    $sex           = $request->sex;
    $date_of_birth = $request->date_of_birth;
    $address       = $request->address;
    
    $data = [
        'fullname'      => $fullname,
        'sex'           => $sex,
        'date_of_birth' => $date_of_birth,
        'address'       => $address
    ];
    $result = $this->mcandidate->editCandidate($data,$id);
    return redirect()->route('recruitment.recruitment.my_acount',['id_info' => $id_info])->with('msg','Success');
  }

  public function job_application()
  { 
    $cats         = $this->cdata_tree->cat();
    $user         = Auth::user();
    $id_candidate = $user->id_user;
    $applys       = $this->mapply->getApplys_Candidate($id_candidate);
    return view('recruitment.recruitment.job_application',compact('cats','applys','user'));
  }

  public function tracked_jobs()
  { 
    $cats         = $this->cdata_tree->cat();
    $user         = Auth::user();
    $id_candidate = $user->id_user;
    $follows      = $this->mfollow->getFollows($id_candidate);
    return view('recruitment.recruitment.tracked_jobs',compact('cats','follows','user'));
  }

  public function del_apply($id)
  {
      $apply   = $this->mapply->getApply($id);
      $cv      = $apply->cv;
      $urlCv   = $_SERVER['DOCUMENT_ROOT'].'/storage/app/files/'.$cv;
      unlink($urlCv);
      $result = $this->mapply->delApply($id);
      return redirect()->route('recruitment.candidate.job_application')->with('msg', 'Deleted successfully.');
  }

  public function download_cv($id)
  {
      $apply  = $this->mapply->getApply($id);
      $name   = $apply->cv;
      $file   = $_SERVER['DOCUMENT_ROOT'].'/storage/app/files/'.$name;
      $headers = array(
          'Content-Type: application/pdf',
      ); 
      $result = Response::download($file, $name,$headers);
      return redirect()->route('recruitment.candidate.job_application')->with('msg', 'Downloaded successfully.');
  }

  public function recruitment($id)
  {
    $cats           = $this->cdata_tree->cat();
    $id_recruitment = $id;
    $apply          = $this->mapply->getApply_Candidate(Auth::user()->id_user,$id_recruitment);
    
    if (Auth::user()->id_info == 2) {
      if ($apply != null) {
        $application_date = $apply->application_date;
        return view('recruitment.recruitment.resubmit',compact('cats','id_recruitment','application_date'));
      }else{
        return view('recruitment.recruitment.recruitment',compact('cats','id_recruitment'));
      }
    }else{
      $recruitment = $this->mrecruitment->getRecruitment($id);
      $rname       = $recruitment->rname;
      $slug        = Str::slug($rname);
      return redirect()->route('recruitment.recruitment.detail',[$slug,$id])->with('mess','You are not authorized to perform this function');
    }
  }

  public function postRecruitment(Request $request,$id)
  {
    $fullname = $request->fullname;
    $email    = $request->email;
    $phone    = $request->phone;
    $message  = $request->message;
    $file     = $request->cv;

    $dt               = Carbon::now('Asia/Ho_Chi_Minh');
    $application_date = $dt->toDateString();

    $candidate    = $this->mcandidate->getCandidate(Auth::user()->id_user);
    $id_candidate = $candidate->id_candidate;

    if ($file->getSize() > 2000000) {
      return redirect()->route('recruitment.candidate.recruitment',$id)->with('msg','The file size is too specified.');
    }
    $filename = $file->store('files');
    $cv       = last(last(Str::of($filename)->explode('/')));
    $data = [
        'id_candidate'     => $id_candidate,
        'fullname'         => $fullname,
        'email'            => $email,
        'phone'            => $phone,
        'message'          => $message,
        'cv'               => $cv,
        'application_date' => $application_date,
        'status_save'      => 0,
        'id_recruitment'   => $id
    ];
    $result      = $this->mapply->addApply($data);
    $recruitment = $this->mrecruitment->getRecruitment($id);
    $rname       = $recruitment->rname;
    $slug        = Str::slug($rname);
    return redirect()->route('recruitment.recruitment.detail',[$slug, $id])->with('msg','Success');
  }
   public function postResubmit(Request $request,$id)
  {
    $submit = $request->submit;
    if ($submit == "no") {
      $recruitment = $this->mrecruitment->getRecruitment($id);
      $rname       = $recruitment->rname;
      $slug        = Str::slug($rname);
      return redirect()->route('recruitment.recruitment.detail',[$slug, $id]);
    }else{
      $cats           = $this->cdata_tree->cat();
      $id_recruitment = $id;
      $apply          = $this->mapply->getApply_Candidate(Auth::user()->id_user,$id_recruitment);
      $id_apply       = $apply->id_apply;
      $cv             = $apply->cv;
      $urlCv   = $_SERVER['DOCUMENT_ROOT'].'/storage/app/files/'.$cv;
      unlink($urlCv);
      $result = $this->mapply->delApply($id_apply);
      return view('recruitment.recruitment.recruitment',compact('cats','id_recruitment'));
    }
  }

  public function changepass_candidate(Request $request)
  {
    $cats         = $this->cdata_tree->cat();
    $user         = Auth::user();
    return view('recruitment.recruitment.changepass_candidate', compact('cats','user'));
  }

  public function postChangepass_candidate(Request $request)
  {
    $old_pass        = $request->old_pass;
    $new_pass        = $request->new_pass;
    $confirm_pass    = $request->confirm_pass;
    if (Auth::attempt(['email' => Auth::user()->email,'password' => $old_pass]) != true){
      return redirect()->route('recruitment.candidate.changepass_candidate')->with('mess', 'Please enter the correct old password.');
    }
    if ($new_pass != $confirm_pass) {
      return redirect()->route('recruitment.candidate.changepass_candidate')->with('mess', 'Please confirm the correct password.');
    }

    $data = [
      'password' => bcrypt($new_pass),
    ];

    $result = $this->muser->editUser($data, Auth::user()->id_user);
    if ($result) {
      return redirect()->route('recruitment.recruitment.my_acount',['id_info' => Auth::user()->id_info])->with('mess', 'Password changed successfully.');
    }else{
      return redirect()->route('recruitment.recruitment.my_acount',['id_info' =>Auth::user()->id_info])->with('mess', 'Error. Please try again.');
    }  
  }
}
