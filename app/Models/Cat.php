<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cat extends Model
{
    use HasFactory;
    protected $table = "cat";
    protected $primaryKey = "id_cat";


    public function getCats()
    {
        return DB::table('cat')
                    ->orderBy('id_cat', 'desc')
                    ->get();
    }

    public function getCat($id)
    {
        return DB::table('cat')
                    ->where('id_cat', $id)
                    ->first();
    }

    public function getDanhmuc($parent_id)
    {
        return DB::table('cat')
                    ->where('parent_id', '<>' ,$parent_id)
                    ->get();
    }

    public function getDanhmucCha()
    {
        return DB::table('cat')
                    ->where('parent_id',0)
                    ->get();
    }

    public function getDanhmucCon($id)
    {
        return DB::table('cat')
                    ->where('parent_id',$id)
                    ->get();
    }

    public function search($id,$city,$gender_requirement,$level,$experience,$type_work,$probationary_period,$rate)
    {
        return DB::table('cat')
                    ->join('recruitment', 'cat.id_cat', '=', 'recruitment.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->where('city', 'LIKE' ,$city)
                    ->where('gender_requirement', 'LIKE' ,$gender_requirement)
                    ->where('level', 'LIKE' ,$level)
                    ->where('experience', 'LIKE' ,$experience)
                    ->where('type_work', 'LIKE' ,$type_work)
                    ->where('probationary_period', 'LIKE' ,$probationary_period)
                    ->where('rate', 'LIKE' ,$rate)
                    ->where('cat.id_cat' ,$id)
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->paginate(8);
    }

    public function getRecruitments($id_cat)
    {
        return DB::table('cat')
                    ->join('recruitment', 'cat.id_cat', '=', 'recruitment.id_cat')
                    ->join('user', 'recruitment.id_user', '=', 'user.id_user')
                    ->where('recruitment.id_cat' ,$id_cat)
                    ->select('recruitment.*', 'cat.*', 'user.fullname')
                    ->paginate(8);
    }

    //admin
    public function addCat($data)
    {
        return DB::table('cat')->insert($data);
    }

    //admin
    public function editCat($data, $id)
    {
        return DB::table('cat')
                    ->where('id_cat', $id)
                    ->update($data);
    }

    //admin
    public function delCat($id)
    {
        return DB::table('cat')
                    ->where('id_cat', $id)
                    ->delete();
    }

    public function delCatLQ($id)
    {
        return DB::table('cat')
                    ->where('parent_id', $id)
                    ->orwhere('id_cat', $id)
                    ->delete();
    }
}
