<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewRecruitmentRequest;
use App\Models\recruitment;
use App\Models\Cat;


use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use View;

class NewRecruitmentController extends Controller
{
  public function __construct(recruitment $mrecruitment, Cat $mcat)
  {
    $this->mrecruitment = $mrecruitment;
    $this->mcat         = $mcat;
  }
  public function index()
  {
    $recruitments = $this->mrecruitment->getRecruitments();  
    return view('admin.recruitment.index', compact('recruitments'));
  }

  public function postIndex(Request $request)
  {
    $status         = $request->status;
    $id_recruitment = $request->id_recruitment;
    if ($status == "2") {
      $status = 1;
      $output = '<form><input type="hidden" name="_token" value="'.csrf_token().'">';
      $output.='<center><a href="javascript:void(0)" onclick="getInfo('.$id_recruitment.','.$status.')"><img src="/public/templates/admin/img/1.png" alt="" width="20px"  height="20px"></a></center>';
      $output.='</form>';
      return $output;
    }
    if ($status == "1") {
      $status = 0;
    }else{
      $status = 1;
    }
    $data = [
      'status' => $status
    ];

    $result = $this->mrecruitment->editRecruitment($data, $id_recruitment);    
    $output = '<form><input type="hidden" name="_token" value="'.csrf_token().'">';
    if ($status == 1) {
      $output.='<center><a href="javascript:void(0)" onclick="getInfo('.$id_recruitment.','.$status.')"><img src="/public/templates/admin/img/1.png" alt="" width="20px"  height="20px"></a></center>';
    }else{
      $output.='<center><a href="javascript:void(0)" onclick="getInfo('.$id_recruitment.','.$status.')"><img src="/public/templates/admin/img/0.jpg" alt="" width="20px"  height="20px"></a></center>';
    }
    $output.='</form>';
    return $output; 
  }
   
  public function del($id)
  {
    $recruitment = $this->mrecruitment->getRecruitment($id);
    $picture     = $recruitment->picture;
    $urlPic = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/'.$picture;
      unlink($urlPic);
    $result = $this->mrecruitment->delRecruitment($id);
    return redirect()->route('admin.recruitment.index')->with('msg', 'Deleted successfully.');
  }
}
