<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Recruitment extends Model
{
    use HasFactory;
    protected $table = "recruitment";
    protected $primaryKey = "id_recruitment";


    public function getRecruitments()
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->orderBy('id_recruitment', 'desc')
                    ->paginate(8);
    }

    public function getAllRecruitments()
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->orderBy('id_recruitment', 'desc')
                    ->get();
    }

    public function search($city,$gender_requirement,$level,$experience,$type_work,$probationary_period,$rate)
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->where('city', 'LIKE' ,$city)
                    ->where('gender_requirement', 'LIKE' ,$gender_requirement)
                    ->where('level', 'LIKE' ,$level)
                    ->where('experience', 'LIKE' ,$experience)
                    ->where('type_work', 'LIKE' ,$type_work)
                    ->where('probationary_period', 'LIKE' ,$probationary_period)
                    ->where('rate', 'LIKE' ,$rate)
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->paginate(8);
    }

    public function getRecruitmentPopulars()
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->orderBy('views', 'desc')
                    ->paginate(3);
    }

    public function getRecruitment($id)
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->join('recruiter','recruitment.id_user', '=', 'recruiter.id_recruiter')
                    ->where('id_recruitment', $id)
                    ->select('recruitment.*', 'cat.*','cat.id_cat as cat_id', 'user.fullname','recruiter.*')
                    ->first();
    }

    public function getRecruitmentsUser($id_user)
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->join('recruiter','recruitment.id_user', '=', 'recruiter.id_recruiter')
                    ->where('recruitment.id_user', $id_user)
                    ->select('recruitment.*', 'cat.*', 'user.fullname','recruiter.*')
                    ->orderBy('id_recruitment','desc')
                    ->paginate(8);
    }
    public static function getRecruitmentsUser_Export($id_user)
    {
        return DB::table('recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->join('recruiter','recruitment.id_user', '=', 'recruiter.id_recruiter')
                    ->where('recruitment.id_user', $id_user)
                    ->select('recruitment.*', 'cat.*', 'user.fullname','recruiter.*')
                    ->orderBy('id_recruitment','desc')
                    ->get();
    }

    //public
    public function getRecruitmentsLQ($id_cat,$id_recruitment)
    {
    	return DB::table('recruitment')
                    ->join('cat','recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->where('recruitment.id_cat',$id_cat)
                    ->where('recruitment.id_recruitment','<>',$id_recruitment)
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->orderBy('id_recruitment', 'desc')
                    ->paginate(4);
    }

    public function getJob_listing($id_user)
    {
        return DB::table('recruitment')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->where('recruitment.id_user', $id_user)
                    ->orderBy('id_recruitment', 'desc')
                    ->paginate(10);
    }

    //admin
    public function addRecruitment($data)
    {
        return DB::table('recruitment')->insert($data);
    }

    //admin
    public function editRecruitment($data, $id)
    {
        return DB::table('recruitment')
                        ->where('id_recruitment', $id)
                        ->update($data);
    }

    //admin
    public function delRecruitment($id)
    {
        return DB::table('recruitment')
                        ->where('id_recruitment', $id)
                        ->delete();
    }
}
