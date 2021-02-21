<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Cat;

use Session;
use Mail;


class AuthController extends Controller
{
	public function __invoke()
  {
       
  }

  public function __construct(User $muser, Recruiter $mrecruiter, Candidate $mcandidate, Cat $mcat)
  {
    $this->muser      = $muser;
    $this->mrecruiter = $mrecruiter;
    $this->mcandidate = $mcandidate;
    $this->mcat       = $mcat;
  }

  public function login()
  {
    return view('auth.auth.login');
  }

  public function postLogin(Request $request)
  {
    $email    = $request->email;
    $password = $request->password;
    $user     = $this->muser->findUser($email);
    if ($user !=  null) {
      $id       = $user->id_user;
      $active   = $user->active;
    }else{
      $active = 3;
    }
    if ($active == 0) {
      return redirect()->route('auth.auth.login')->with('msg', 'Your account has been locked');
    }else{
      if (Auth::attempt(['email' => $email, 'password' => $password ])) {
        return redirect()->route('recruitment.index.index');
      }else{
        if ($request->session()->exists($email)) {
          $dem = $request->session()->get($email) +1;
          $request->session()->put($email, $dem);
          if ($request->session()->get($email) == 3) {
            $data = [
                 'active' => 0,
            ];
            $result = $this->muser->editUser($data,$id);
            $request->session()->forget($email);
            return redirect()->route('auth.auth.login')->with('msg', 'Your account has been locked');
          }else{
            return redirect()->route('auth.auth.login')->with('msg', 'Wrong email or password');
          }
      }else{
          $request->session()->put($email, 1);
          return redirect()->route('auth.auth.login')->with('msg', 'Wrong email or password');
        }  
      } 
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('recruitment.index.index');
  }

  public function register_candidate()
  {
   	return view('auth.auth.register_candidate');
  }

  public function postRegister_candidate(Request $request)
  {
    $email    = $request->email;
    $password = bcrypt($request->password);
    $fullname = $request->fullname;

    $users = $this->muser->getUsers();
    $dem = 0;
    foreach ($users as $user){
       if ($user->email == $email) {
          $dem++;
       }
    }
    if ($dem > 0) {
       return redirect()->route('auth.auth.register_candidate')->with('msg', 'User already exists.');
    }
    $data = [
       'password'  => $password,
       'fullname'  => $fullname,
       'email'     => $email,
       'id_info'   => 2,
       'active'    => 1,
       'status_comment' => 1, 
    ];
    $result = $this->muser->addUser($data);
    if ($result) {
       return redirect()->route('auth.auth.login')->with('msg', 'Sign Up Success.');
    }else{
       return redirect()->route('auth.auth.register_candidate')->with('msg', 'Error. Please try again.');
    }  
  }

  public function register_recruiter()
  {
    $cats = $this->mcat->getDanhmucCha(0);
    return view('auth.auth.register_recruiter',compact('cats'));
  }

  public function postRegister_recruiter(Request $request)
  {
    $email            = $request->email;
    $password         = bcrypt($request->password);
    $fullname         = $request->fullname;
    $company_name     = $request->company_name;
    $city             = $request->city;
    $address          = $request->address;
    $id_cat           = $request->id_cat;
    $company_profile  = $request->company_profile;
    $fullname_contact = $request->fullname_contact;
    $phone_contact    = $request->phone_contact;
    $email_contact    = $request->email_contact;

    $users = $this->muser->getUsers();
    $dem = 0;
    foreach ($users as $user){
       if ($user->email == $email) {
          $dem++;
       }
    }
    if ($dem > 0) {
       return redirect()->route('auth.auth.register_recruiter')->with('msg', 'User already exists.');
    }
    $data = [
       'password'  => $password,
       'fullname'  => $fullname,
       'email'     => $email,
       'id_info'   => 1,
       'active'    => 2,
       'status_comment' => 1, 
    ];
    $result       = $this->muser->addUser($data);
    $id_recruiter = $this->muser->findID();
    $user         = $this->muser->findUser($email);
    $id_user      = $user->id_user;
    $data1 = [
       'id_recruiter'     => $id_recruiter,
       'company_name'     => $company_name,
       'city'             => $city,
       'address'          => $address,
       'id_cat'           => $id_cat,
       'company_profile'  => $company_profile,
       'fullname_contact' => $fullname_contact,
       'phone_contact'    => $phone_contact,
       'email_contact'    => $email_contact,
       'money'            => 0,
    ];
    $result1 = $this->mrecruiter->addRecruiter($data);
    $data2 = [
        'id_user' => $id_user,
    ];
    Mail::send('auth/auth/email_confirm',$data2,function($message){
                $message->from('sangphan297@gmail.com','Sang'); 
                $message->to($email,'Sang297');  
                $message->subject('Confirm');
    });
    return redirect()->route('auth.auth.login')->with('msg', 'Please check your email for confirmation.');  
  }  

  public function forgetpass()
  {
    return view('auth.auth.forgetpass');
  }

  public function email_confirm()
  { 
    return view('auth.auth.email_confirm');
  }

  public function confirm(Request $request)
  {
    $id_user = $request->id_user;
    $data = [
       'active' => 1,
    ];
    $result = $this->muser->editUser($data, $id_user);
    return view('auth.auth.login');
  }

  public function email()
  { 
    return view('auth.auth.email');
  }

  public function postForgetpass(Request $request)
  {
    $email    = $request->email;
    $user     = $this->muser->findUser($email);
    if ($user == null) {
       return redirect()->route('auth.auth.forgetpass')->with('msg', 'Enter incorrect account information.');
    }
    $id_user = $user->id_user;
    $data = [
        'id_user' => $id_user,
    ];
    Mail::send('auth/auth/email',$data,function($message){
                $message->from('sangphan297@gmail.com','Sang'); 
                $message->to('sangphan297@gmail.com','Sang297');  
                $message->subject('Password retrieval');
    });
    return redirect()->route('auth.auth.login')->with('msg', 'Please check email to change password.');  
  }

  public function changepass(Request $request)
  {
    $id_user  = $request->id_user;
    return view('auth.auth.changepass', compact('id_user'));
  }

  public function postChangepass(Request $request)
  {
    $id_user         = $request->id_user;
    $password        = $request->password;
    $passwordconfirm = $request->passwordconfirm;

    if ($password != $passwordconfirm) {
      return redirect()->route('auth.auth.forgetpass')->with('msg', 'Please confirm the correct password.');
    }

    $data = [
      'password' => bcrypt($password),
    ];

    $result = $this->muser->editUser($data,$id_user);
    if ($result) {
      return redirect()->route('auth.auth.login')->with('msg', 'Password changed successfully.');
    }else{
      return redirect()->route('auth.auth.login')->with('msg', 'Error. Please try again.');
    }  
  }
      
}
