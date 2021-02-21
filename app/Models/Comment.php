<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $primaryKey = "id_comment";


    public function getAllComments()
    {
        return DB::table('comment')
                    ->join('recruitment', 'comment.id_recruitment', '=', 'recruitment.id_recruitment')
                    ->join('user', 'comment.id_user', '=', 'user.id_user')
                    ->orderBy('id_comment', 'desc')
                    ->paginate(10);
    }

    public function getComments($id_recruitment)
    {
        return DB::table('comment')
                    ->join('user', 'comment.id_user', '=', 'user.id_user')
                    ->where('comment.id_recruitment', $id_recruitment)
                    ->orderBy('id_comment', 'desc')
                    ->get();
    }

    // public function search($search)
    // {    
    //     return DB::table('comment')
    //                 ->join('recruitment', 'comment.id_recruitment', '=', 'recruitment.id_recruitment')
    //                 ->join('user', 'comment.id_user', '=', 'user.id_user')
    //                 ->where('user.fullname','LIKE', '%'.$search.'%')
    //                 ->orwhere('recruitment.pname','LIKE', '%'.$search.'%')
    //                 ->orderBy('id_comment', 'desc')
    //                 ->paginate(10);
    // }

    //admin
    public function addComment($data)
    {
        return DB::table('comment')->insert($data);
    }

    //admin
    public function editComment($data, $id)
    {
        return DB::table('comment')
                        ->where('id_comment', $id)
                        ->update($data);
    }

    //admin
    public function delComment($id)
    {
        return DB::table('comment')
                        ->where('id_comment', $id)
                        ->delete();
    }
}
