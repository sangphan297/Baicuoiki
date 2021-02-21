<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Comment;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Recruitment;
use App\Models\Apply;
use App\Models\FollowRecruitment;

use Auth;
use Carbon\Carbon;
use Session;
use DateTime;
use Str;

class RecruitmentController extends Controller
{
	public function __construct(Cat $mcat, Comment $mcomment, User $muser, DataTreeController $cdata_tree, Recruitment $mrecruitment, Apply $mapply, Candidate $mcandidate, Recruiter $mrecruiter, FollowRecruitment $mfollow)
  {
    $this->mcat         = $mcat;
    $this->mcomment     = $mcomment;
    $this->muser        = $muser;
    $this->mapply       = $mapply;
    $this->cdata_tree   = $cdata_tree;
    $this->mcandidate   = $mcandidate;
    $this->mrecruiter   = $mrecruiter;
    $this->mrecruitment = $mrecruitment;
    $this->mfollow      = $mfollow;
  }

	public function cat($slug, $id)
  {
    $cats         = $this->cdata_tree->cat();
    $recruitments = $this->mcat->getRecruitments($id);
    return view('recruitment.recruitment.cat',compact('cats','recruitments','slug','id'));
  }

  public function search(Request $request, $slug, $id)
  {
    $city                = $request->city;
    $gender_requirement  = $request->gender_requirement;
    $level               = $request->level;
    $experience          = $request->experience;
    $type_work           = $request->type_work;
    $probationary_period = $request->probationary_period;
    $rate                = $request->rate;

    $cats         = $this->cdata_tree->cat();
    $recruitments = $this->mcat->search($id,$city,$gender_requirement,$level,$experience,$type_work,$probationary_period,$rate);
    $count        = $recruitments->count();
    return view('recruitment.recruitment.search',compact('cats','recruitments','count','slug','id','gender_requirement','level','experience','type_work','probationary_period','rate','city'));
  }

  public function detail(Request $request,$slug, $id)
  {
    $cats           = $this->cdata_tree->cat();
    $recruitment    = $this->mrecruitment->getRecruitment($id);
    $cat_id         = $recruitment->cat_id;
    $views          = $recruitment->views;
    $comments       = $this->mcomment->getComments($id);

    $now = time();
    if ($request->session()->has('tin-'.$id)) {
        $pasttime = $request->session()->get('tin-'.$id);           
        if (($now - $pasttime) >= 10) {
          $request->session()->put('tin-'.$id, $now);
          $views = $views + 1;
          $data  = [
             'views' => $views,
          ];
          $result = $this->mrecruitment->editRecruitment($data, $id);
        }
    }else{
        $request->session()->put('tin-'.$id, $now);
        $views = $views + 1;
        $data  = [
          'views' => $views,
        ];
        $result = $this->mrecruitment->editRecruitment($data, $id);
    }

    $recruitment    = $this->mrecruitment->getRecruitment($id);
    $recruitmentsLQ = $this->mrecruitment->getRecruitmentsLQ($cat_id,$id);
    if (Auth::check()) {
      $follow = $this->mfollow->getFollow(Auth::user()->id_user, $id);
      if ($follow == null) {
        $status_follow = 0;
      }else{
        $status_follow =$follow->status_follow;
      }
    }else{
      $status_follow = 0;
    }
    return view('recruitment.recruitment.detail',compact('cats','recruitment', 'recruitmentsLQ','comments', 'status_follow'));
  }

  public function my_acount(Request $request)
  {
    $id_info = $request->id_info;
    $cats    = $this->cdata_tree->cat();
    if ($id_info == 1 ) {
      $user       = $this->mrecruiter->getRecruiter(Auth::user()->id_user);
      if ($user == null) {
        $user = $this->muser->getUser(Auth::user()->id_user);
      }
      $type_works = $this->mcat->getDanhmucCha(0);
      return view('recruitment.recruitment.my_acount_recruiter',compact('cats','user','type_works'));
    }else{
      $user = $this->mcandidate->getCandidate(Auth::user()->id_user); 
      if ($user == null) {
        $user = $this->muser->getUser(Auth::user()->id_user);
        $id   = $user->id_user;
      }else{
        $id   = $user->id_candidate;
      }
      return view('recruitment.recruitment.my_acount_candidate',compact('cats','user','id'));
    }
  }


  public function postComment(Request $request)
  {
    if (Auth::check()) {
      $user           = Auth::user();
      $id_user        = $user->id_user;
      $status_comment = $user->status_comment;
      $id_recruitment = $request->id_recruitment;
      $comment        = $request->comment;  
      if ($status_comment == 1) {
        $data = [
         'id_user'        => $id_user,
         'comment'        => $comment,
         'id_recruitment' => $id_recruitment,
        ];

        $chars = array("LOL","Chó","Ngu");
        $dem = 0;
        for ($i=0; $i < sizeof($chars) ; $i++) { 
        $timkiem = $chars[$i];
          if (stripos($comment, $timkiem) !== false) {
            $dem++;
          }
        }
        if ($dem > 0) {
          $update = [
            'status_comment' => 0            
          ];
          $ketqua = $this->muser->editUser($update, $id_user);
          return "Khoa";
        }else{
          $result = $this->mcomment->addComment($data);
        }
        $comments = $this->mcomment->getComments($id_recruitment);
        $output = "";
        foreach ($comments as  $binhluan) {
          $comment           = $binhluan->comment;
          $status_comment    = $binhluan->status_comment;
          $fullname          = $binhluan->fullname;
          if ($status_comment == 1) {
            $output .= '<div class="media">
                        <div class="media-left">
                          <img src="/public/templates/recruitment/upload/anh2.jpg" alt="" class="rounded-circle">
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading user_name">'.$fullname.'</h4>
                          <p>'.$comment.'</p>
                        </div>
                      </div>';
          }
        }
        return $output;
      }else{
        return "Khoa";
      }      
    }else{
      return 'NOK';
    } 
  }

  public function postFollow(Request $request)
  {
    if (Auth::check()) {
      $user           = Auth::user();
      $id_user        = $user->id_user;
      $id_recruitment = $request->id_recruitment;
      $status_follow  = $request->status_follow;

      $dt         = Carbon::now('Asia/Ho_Chi_Minh');
      $track_date = $dt->toDateString();
      if ($user->id_info != 2) {
        return 'NYOU';
      }
      $follow = $this->mfollow->getFollow($id_user, $id_recruitment);
      $output = '<input type="hidden" name="_token" value="'.csrf_token().'">';
      if ($follow == null) {
        $data = [
          'status_follow'  => 1,
          'id_candidate'   => $id_user,
          'id_recruitment' => $id_recruitment,
          'track_date'     => $track_date,
        ];
        $ketqua = $this->mfollow->addFollow($data);
        $output.='<a href="javascript:void(0)" onclick="changeStatus(1,'.$id_recruitment.')">Unfollow</a>';
        return $output;
      }else{
        $id_follow = $follow->id_follow;
        if ($status_follow == 1) {
          $status_follow = 0;
          $edit = [
            'status_follow' => $status_follow,
            'track_date'    => $track_date,
          ];
          $result = $this->mfollow->delFollow($id_follow);
        }else{
          $status_follow = 1;
          $edit = [
            'status_follow' => $status_follow,
            'track_date'    => $track_date,
          ];
        }
        $ketqua = $this->mfollow->editFollow($edit, $id_follow);
        if ($status_follow == 1) {
            $output.='<a href="javascript:void(0)" onclick="changeStatus('.$status_follow.','.$id_recruitment.')">Unfollow</a>';
        }else{
            $output.='<a href="javascript:void(0)" onclick="changeStatus('.$status_follow.','.$id_recruitment.')">Follow</a>';
        }
        return $output;
      }
    }else{
      return 'NOK';
    }
  }

}
