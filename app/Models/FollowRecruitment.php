<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FollowRecruitment extends Model
{
    use HasFactory;
    protected $table = "follow_recruitment";
    protected $primaryKey = "id_follow";


    public function getFollows($id_candidate)
    {
        return DB::table('follow_recruitment')
                    ->join('recruitment', 'follow_recruitment.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->where('follow_recruitment.id_candidate', $id_candidate)
                    ->orderBy('id_follow', 'desc')
                    ->paginate(10);
    }

    public function getFollow($id_candidate,$id_recruitment)
    {
        return DB::table('follow_recruitment')
                    ->join('recruitment', 'follow_recruitment.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('cat', 'recruitment.id_cat', '=', 'cat.id_cat')
                    ->where('follow_recruitment.id_candidate', $id_candidate)
                    ->where('follow_recruitment.id_recruitment', $id_recruitment)
                    ->first();
    }


    //admin
    public function addFollow($data)
    {
        return DB::table('follow_recruitment')->insert($data);
    }

    public function editFollow($data, $id)
    {
        return DB::table('follow_recruitment')
                    ->where('id_follow', $id)
                    ->update($data);
    }

    public function delFollow( $id)
    {
        return DB::table('follow_recruitment')
                    ->where('id_follow', $id)
                    ->delete();
    }
}
