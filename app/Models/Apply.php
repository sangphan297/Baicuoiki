<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Apply extends Model
{
    use HasFactory;
    protected $table = "apply";
    protected $primaryKey = "id_apply";


    public function getApplys()
    {
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->orderBy('id_apply', 'desc')
                    ->paginate(10);
    }

    public function getApplys_Recruiter($id_recruiter)
    {
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->where('id_user', $id_recruiter)
                    ->orderBy('id_apply', 'desc')
                    ->paginate(10);
    }
    public function getApplys_Candidate($id_candidate)
    {   
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('recruiter','recruitment.id_user', '=', 'recruiter.id_recruiter')    
                    ->where('id_candidate', $id_candidate)
                    ->orderBy('id_apply', 'desc')
                    ->paginate(10);
    }

    public function getApply_Candidate($id_candidate,$id_recruitment)
    {   
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->join('recruiter','recruitment.id_user', '=', 'recruiter.id_recruiter')    
                    ->where('id_candidate', $id_candidate)
                    ->where('apply.id_recruitment', $id_recruitment)
                    ->first();
    }

    public function getApplys_Saved($id_recruiter)
    {
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->where('id_user', $id_recruiter)
                    ->where('status_save', 1)
                    ->orderBy('id_apply', 'desc')
                    ->paginate(10);
    }

    public function getApply($id)
    {
        return DB::table('apply')
                    ->join('recruitment', 'apply.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->where('id_apply', $id)
                    ->first();
    }

    public function getApplication_number_of_recruitment($id)
    {
        return DB::table('apply')
                    ->where('id_recruitment', $id)
                    ->count();
    }
    public static function getCountApplication($id)
    {
        return DB::table('apply')
                    ->where('id_recruitment', $id)
                    ->count();
    }

    //admin
    public function addApply($data)
    {
        return DB::table('apply')->insert($data);
    }

    public function editApply($data, $id)
    {
        return DB::table('apply')
                    ->where('id_apply', $id)
                    ->update($data);
    }

    //admin
    public function delApply($id)
    {
        return DB::table('apply')
                    ->where('id_apply', $id)
                    ->delete();
    }

}
