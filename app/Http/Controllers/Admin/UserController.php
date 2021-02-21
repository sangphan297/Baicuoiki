<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\UserRequest;
use Auth;


class UserController extends Controller
{
    public function __construct(User $muser)
    {
    	$this->muser = $muser;
    }

    public function index()
    {
    	$users = $this->muser->getAdmins();
    	return view('admin.user.index',compact('users'));
        dd($users);
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

    public function add()
    {
    	return view('admin.user.add');
    }

    public function postAdd(UserRequest $request)
    {
        $password  = bcrypt($request->password);
        $fullname  = $request->fullname;
        $email     = $request->email;

        $users = $this->muser->getUsers();
        $dem1 = 0;
        foreach ($users as $user){
            if ($user->email == $email) {
               $dem1++;
            }
        }
        if ($dem1 > 0) {
            return redirect()->route('admin.user.add')->with('msg', 'Email already exists.');
        }  
        
        $data = [
            'password'  => $password,
            'fullname'  => $fullname,
            'email'     => $email,
            'id_info'   => 0,
            'active'    => 1,
            'status_comment' => 1,
        ];
        $result = $this->muser->addUser($data);
        if ($result) {
            return redirect()->route('admin.user.index')->with('msg', 'More success.');
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Error. Please try again.');
        }  
    }
    //edit
    public function edit($id)
    {   
        $user = $this->muser->getUser($id);
        return view('admin.user.edit', compact('user'));
    }

    public function postEdit(Request $request, $id)
    {
        $password  = $request->password;
        $fullname  = $request->fullname;
        $email     = $request->email;

        if ($password == null) {
           $data = [
            'fullname' => $fullname,
            'email'    => $email
        ];
        }else{
            $data = [
            'password' => bcrypt($password),
            'fullname' => $fullname,
            'email'    => $email,
        ];
        }
        
        $users = $this->muser->getUsers();
        $dem1 = 0;
        foreach ($users as $user){
            if ($user->email == $email) {
               $dem1++;
            }
        }
        if ($dem1 > 2) {
            return redirect()->route('admin.user.edit')->with('msg', 'Email already exists.');
        }  

        $result = $this->muser->editUser($data, $id);
        if ($result) {
            return redirect()->route('admin.user.index')->with('msg', 'Corrected successfully.');
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Error. Please try again.');
        }  
    }
   
   public function del($id)
    {
        $result = $this->muser->delUser($id);
        if ($result) {
             return redirect()->route('admin.user.index')->with('msg', 'Deleted successfully.');
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Error. Please try again.');
        } 
        
    }
}
