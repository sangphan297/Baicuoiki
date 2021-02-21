<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recruiter;

use App\Http\Requests\UserRequest;
use Auth;


class AdminRecruiterController extends Controller
{
    public function __construct(User $muser, Recruiter $mrecruiter)
    {
    	$this->muser      = $muser;
        $this->mrecruiter = $mrecruiter;
    }

    public function index()
    {
    	$users = $this->muser->getRecruiters();
    	return view('admin.recruiter.index',compact('users'));
    }

    public function postIndex(Request $request)
    {
        $active  = $request->active;
        $id_user = $request->id_user;
        if ($active == 1) {
           $active = 0;
        }else{
           $active = 1;  
        }
        $data = [
            'active' => $active,
        ];

        $result = $this->muser->editUser($data, $id_user);    
        $output = '<form><input type="hidden" name="_token" value="'.csrf_token().'">';
        if ($active == 1) {
            $output.='<center><a href="javascript:void(0)" onclick="getInfo('.$id_user.','.$active.')"><img src="/public/templates/admin/img/1.png" alt="" width="20px"  height="20px"></a></center>';
        }else{
            $output.='<center><a href="javascript:void(0)" onclick="getInfo('.$id_user.','.$active.')"><img src="/public/templates/admin/img/0.jpg" alt="" width="20px"  height="20px"></a></center>';
        }
        $output.='</form>';
        return $output; 
    }

    public function postMethod(Request $request)
    {
        $status_comment  = $request->status_comment;
        $id_user         = $request->id_user;
        if ($status_comment == 1) {
           $status_comment = 0;
        }else{
           $status_comment = 1;  
        }
        $data = [
            'status_comment' => $status_comment,
        ];

        $result = $this->muser->editUser($data, $id_user);    
        $output = '<form><input type="hidden" name="_token" value="'.csrf_token().'">';
        if ($status_comment == 1) {
            $output.='<center><a href="javascript:void(0)" onclick="changeStatus('.$id_user.','.$status_comment.')" style="color: green;">Lock</a></center>';
        }else{
            $output.='<center><a href="javascript:void(0)" onclick="changeStatus('.$id_user.','.$status_comment.')" style="color: red;">Unlock</a></center>';
        }
        $output.='</form>';
        return $output; 
    }

   
   public function del($id)
    {
        $result = $this->muser->delUser($id);
        $result1 = $this->mrecruiter->delRecruiter($id);
        if ($result && $result1) {
             return redirect()->route('admin.recruiter.index')->with('msg', 'Deleted successfully.');
        }else{
            return redirect()->route('admin.recruiter.index')->with('msg', 'Error. Please try again.');
        } 
        
    }
}
