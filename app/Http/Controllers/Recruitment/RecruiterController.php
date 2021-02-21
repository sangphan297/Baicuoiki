<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Models\Recruiter;
use App\Models\Cat;
use App\Models\Recruitment;
use App\Models\Apply;
use App\Models\User;
use App\Models\Payment;
use App\Exports\RecruitmentExport;

use Auth;
use Carbon\Carbon;
use Session;
use DateTime;
use Str;
use Response;
use Excel;

class RecruiterController extends Controller
{
	public function __construct(Recruitment $mrecruitment, DataTreeController $cdata_tree, Recruiter $mrecruiter, Cat $mcat, Apply $mapply, User $muser, Payment $mpayment)
	{
    	$this->cdata_tree   = $cdata_tree;
    	$this->mrecruiter   = $mrecruiter;
        $this->mrecruitment = $mrecruitment;
        $this->mcat         = $mcat;
        $this->mapply       = $mapply;
        $this->mpayment     = $mpayment;
        $this->muser        = $muser;
	}

    public function publish_recruitment()
    {
        if (Auth::user()->active == 2) {
            return redirect()->route('recruitment.recruitment.my_acount',['id_info' => Auth::user()->id_info])->with('mess','Please confirm email to post job vacancies');
        }
        $cats       = $this->cdata_tree->cat();
        $user       = $this->mrecruiter->getRecruiter(Auth::user()->id_user);
        $type_works = $this->mcat->getDanhmucCha(0);

        $id_cat     = $user->id_cat;
        $positions  = $this->mcat->getDanhmucCon($id_cat);

        return view('recruitment.recruitment.publish_recruitment',compact('cats','type_works','user', 'positions'));
    }

    public function postPublish_recruitment(Request $request)
    {
        $rname               = $request->rname;
        $id_cat              = $request->id_cat;
        $amount              = $request->amount;
        $rate                = $request->rate;
        $gender_requirement  = $request->gender_requirement;
        $address             = $request->address;
        $type_work           = $request->type_work;
        $description         = $request->description;
        $experience          = $request->experience;
        $level               = $request->level;
        $city                = $request->city;
        $probationary_period = $request->probationary_period;
        $job_requirement     = $request->job_requirement;
        $expired_time        = $request->expired_time;
        $benefit             = $request->benefit;
        $type_new            = $request->type_new;

        $path                = $request->file('picture');
        $filename            = $path->store('/public');
        $picture             = last(last(Str::of($filename)->explode('/')));

        $dt         = Carbon::now('Asia/Ho_Chi_Minh');
        $created_at = $dt->toDateString();

        if ($type_new == 'pending') {
            $status = 2;
        }else{
            $status = 1;
            $recruiter = $this->mrecruiter->getRecruiter(Auth::user()->id_user);
            $money     = $recruiter->money;
            if ($money < 50000) {
                return redirect()->route('recruitment.recruiter.publish_recruitment')->with('msg', 'Not enough money');
            }else{
                $money = $money-50000;
                $updateMoney = [
                    'money' => $money,
                ];
                $result1 = $this->mrecruiter->editRecruiter($updateMoney,Auth::user()->id_user);
            }
        }
        $data = [
            'rname'               => $rname,
            'id_cat'              => $id_cat,
            'description'         => $description,
            'rate'                => $rate,
            'address'             => $address,
            'views'               => 0, 
            'picture'             => $picture,
            'status'              => $status,
            'type_work'           => $type_work,
            'created_at'          => $created_at,
            'gender_requirement'  => $gender_requirement,
            'experience'          => $experience,
            'level'               => $level,
            'city'                => $city,
            'probationary_period' => $probationary_period,
            'job_requirement'     => $job_requirement,
            'expired_time'        => $expired_time,
            'benefit'             => $benefit,
            'amount'              => $amount,
            'id_user'             => Auth::user()->id_user,
        ];
        $result = $this->mrecruitment->addRecruitment($data);
        if ($result) {
            return redirect()->route('recruitment.recruiter.job_listing')->with('msg', 'More success.');
        }else{
            return redirect()->route('recruitment.recruiter.job_listing')->with('msg', 'Error. Please try again.');
        }  
    }

    public function postUpdate_recruiter(Request $request,$id)
    {
        $id_info       = $request->id_info;
        $address          = $request->address;
        $city             = $request->city;
        $id_cat           = $request->id_cat;
        $company_profile  = $request->company_profile;
        $fullname_contact = $request->fullname_contact;
        $phone_contact    = $request->phone_contact;
        $email_contact    = $request->email_contact;
        $data = [
            'address'          => $address,
            'city'             => $city,
            'id_cat'           => $id_cat,
            'company_profile'  => $company_profile,
            'fullname_contact' => $fullname_contact,
            'phone_contact'    => $phone_contact,
            'email_contact'    => $email_contact,
        ];
        $result = $this->mrecruiter->editRecruiter($data,$id);
        return redirect()->route('recruitment.recruitment.my_acount',['id_info' => $id_info])->with('msg','Thành công');
    }

    public function job_listing()
    {
        $cats              = $this->cdata_tree->cat();
        $job_listings      = $this->mrecruitment->getJob_listing(Auth::user()->id_user);
        $arResutls = [];

        $dt  = Carbon::now('Asia/Ho_Chi_Minh');
        $now = $dt->toDateString();
        foreach ($job_listings as $job_listing) {
            $id_recruitment = $job_listing->id_recruitment;
            $rname          = $job_listing->rname;
            $amount         = $job_listing->amount;
            $expired_time   = $job_listing->expired_time;
            $status         = $job_listing->status;
            if ( (strtotime($expired_time)-strtotime($now)) > 0 ) {
                if ($status == 0) {
                $name_status = 'Hidden';
                }elseif ($status == 1) {
                    $name_status = 'Approved';
                }else{
                    $name_status = 'Approving';
                }
            }else{
                $name_status = 'Expired';
            }
            $application_number = $this->mapply->getApplication_number_of_recruitment($id_recruitment);
            $arNew = array(
                'id_recruitment'     => $id_recruitment,
                'rname'              => $rname,
                'amount'             => $amount,
                'name_status'        => $name_status,
                'expired_time'       => $expired_time,
                'application_number' => $application_number,
            );
            $arResutls['New-'.$id_recruitment] = $arNew;
        }
        return view('recruitment.recruitment.job_listing',compact('cats','arResutls','job_listings'));
    }

    public function application_file()
    {
        $cats   = $this->cdata_tree->cat();
        $applys = $this->mapply->getApplys_Recruiter(Auth::user()->id_user);
        return view('recruitment.recruitment.application_file',compact('cats','applys'));
    }

    public function del_apply($id)
    {
        $apply   = $this->mapply->getApply($id);
        $cv      = $apply->cv;
        $urlCv  = $_SERVER['DOCUMENT_ROOT'].'/storage/app/files/'.$cv;
        unlink($urlCv);
        $result = $this->mapply->delApply($id);
        return redirect()->route('recruitment.recruiter.application_file')->with('msg', 'Deleted successfully.');
    }
    public function save_apply($id)
    {
        $apply       = $this->mapply->getApply($id);
        $status_save = $apply->status_save;
        if ($status_save == 0) {
            $data = [
                'status_save' => 1
            ];
            $result = $this->mapply->editApply($data,$id);
            return redirect()->route('recruitment.recruiter.application_file')->with('msg', 'Saved successfully.');
        }else{
            $data = [
                'status_save' => 0
            ];
            $result = $this->mapply->editApply($data,$id);
            return redirect()->route('recruitment.recruiter.application_file')->with('msg', 'Unsaved successfully.');
        }
    }

    public function saved_file()
    {
        $cats   = $this->cdata_tree->cat();
        $applys = $this->mapply->getApplys_Saved(Auth::user()->id_user);
        return view('recruitment.recruitment.saved_file',compact('cats','applys'));
    }

    public function download_cv($id)
    {
        $apply  = $this->mapply->getApply($id);
        $name   = $apply->cv;
        $file   = $_SERVER['DOCUMENT_ROOT'].'/storage/app/files/'.$name;
        $headers = array(
            'Content-Type: application/pdf',
        ); 
        $result = Response::download($file,"abc.pdf",$headers);
        return redirect()->route('recruitment.recruiter.application_file')->with('msg', 'Downloaded successfully.');
    }

    public function preview_recruitment($id)
    {
        $cats = $this->cdata_tree->cat();
        $recruitment = $this->mrecruitment->getRecruitment($id);
        return view('recruitment.recruitment.preview_recruitment',compact('cats','recruitment'));
    }

    public function modify_recruitment($id)
    {
        $cats        = $this->cdata_tree->cat();
        $recruitment = $this->mrecruitment->getRecruitment($id);
        $user        = $this->mrecruiter->getRecruiter(Auth::user()->id_user);
        $id_cat      = $user->id_cat;
        $positions   = $this->mcat->getDanhmucCon($id_cat);

        return view('recruitment.recruitment.modify_recruitment',compact('cats','recruitment', 'positions', 'user'));
    }

    public function postModify_recruitment(Request $request, $id)
    {
        $rname               = $request->rname;
        $id_cat              = $request->id_cat;
        $amount              = $request->amount;
        $rate                = $request->rate;
        $gender_requirement  = $request->gender_requirement;
        $type_work           = $request->type_work;
        $description         = $request->description;
        $experience          = $request->experience;
        $level               = $request->level;
        $probationary_period = $request->probationary_period;
        $job_requirement     = $request->job_requirement;
        $expired_time        = $request->expired_time;
        $benefit             = $request->benefit;

        $data = [
            'rname'               => $rname,
            'id_cat'              => $id_cat,
            'description'         => $description,
            'rate'                => $rate,
            'type_work'           => $type_work,
            'gender_requirement'  => $gender_requirement,
            'experience'          => $experience,
            'level'               => $level,
            'probationary_period' => $probationary_period,
            'job_requirement'     => $job_requirement,
            'expired_time'        => $expired_time,
            'benefit'             => $benefit,
            'amount'              => $amount,
        ];
        $result = $this->mrecruitment->editRecruitment($data,$id);
        if ($result) {
            return redirect()->route('recruitment.recruiter.preview_recruitment',$id)->with('msg', 'More success.');
        }else{
            return redirect()->route('recruitment.recruiter.preview_recruitment',$id)->with('msg', 'Error. Please try again.');
        }  
    }

    public function del_recruitment($id)
    {
        $recruitment = $this->mrecruitment->getRecruitment($id);
        $picture     = $recruitment->picture;
        $urlPic = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/'.$picture;
        unlink($urlPic);
        $result = $this->mrecruitment->delRecruitment($id);
        return redirect()->route('recruitment.recruiter.job_listing')->with('msg', 'Deleted successfully.');
    }

    public function changepass_recruiter(Request $request)
    {
        $cats = $this->cdata_tree->cat();
        $user = Auth::user();
        return view('recruitment.recruitment.changepass_recruiter', compact('cats','user'));
    }

    public function postChangepass_recruiter(Request $request)
    {
        $old_pass     = $request->old_pass;
        $new_pass     = $request->new_pass;
        $confirm_pass = $request->confirm_pass;
        if (Auth::attempt(['email' => Auth::user()->email,'password' => $old_pass]) != true){
          return redirect()->route('recruitment.recruiter.changepass_recruiter')->with('mess', 'Please enter the correct old password.');
        }
        if ($new_pass != $confirm_pass) {
          return redirect()->route('recruitment.recruiter.changepass_recruiter')->with('mess', 'Please confirm the correct password.');
        }

        $data = [
          'password' => bcrypt($new_pass),
        ];

        $result = $this->muser->editUser($data, Auth::user()->id_user);
        if ($result) {
          return redirect()->route('recruitment.recruitment.my_acount',['id_info' => Auth::user()->id_info])->with('message', 'Password changed successfully.');
        }else{
          return redirect()->route('recruitment.recruitment.my_acount',['id_info' =>Auth::user()->id_info])->with('message', 'Error. Please try again.');
        }  
    }

    public function recharge()
    {
        $cats = $this->cdata_tree->cat();
        return view('recruitment.recruitment.recharge',compact('cats'));
    }

    public function postRecharge(Request $request)
    {
        $vnp_TmnCode    = "Y4U88XFK";
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
        $vnp_Url        = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl  = "http://quanli.vn/transaction_history";

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

        $vnp_TxnRef    = $request->order_id;
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount    = $request->amount * 100;
        $vnp_Locale    = $request->language;
        $vnp_BankCode  = $request->bank_code;
        $vnp_IpAddr    = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version"    => "2.0.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
                        'code' => '00'
                        , 'message' => 'success'
                        , 'data' => $vnp_Url
                        );
        $dt  = Carbon::now('Asia/Ho_Chi_Minh');
        $date_of_filing = $dt->toDateString();
        $data = [
            'amount'         => $request->amount,
            'date_of_filing' => $date_of_filing,
            'id_recruiter'   => Auth::user()->id_user,
        ];
        $result = $this->mpayment->addPayment($data);
        if ($result) {
           $recruiter = $this->mrecruiter->getRecruiter(Auth::user()->id_user);
           $money     = $recruiter->money + $request->amount;
           $updateMoney = [
                'money' => $money,
           ];
           $result1 = $this->mrecruiter->editRecruiter($updateMoney,Auth::user()->id_user);
        }
        return redirect()->to($returnData['data']);
    }

    public function transaction_history()
    {
        $cats     = $this->cdata_tree->cat();
        $payments = $this->mpayment->getPayments_Recruiter(Auth::user()->id_user);
        $total    = $this->mpayment->getTotal_Recruiter(Auth::user()->id_user);
        return view('recruitment.recruitment.transaction_history',compact('cats','payments','total'));
    }
    public function export_recruitment()
    {
        return Excel::download(new RecruitmentExport, 'recruiment.xlsx');
    }
}
