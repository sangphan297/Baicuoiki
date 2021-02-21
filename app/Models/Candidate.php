<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class Candidate extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $table = "candidate";
    protected $primaryKey = "id_candidate";

    public function getCandidates()
    {
        return DB::table('candidate')
                ->join('user','candidate.id_candidate', '=', 'user.id_user')
                ->paginate(5);
    }

    public function getAllCandidates()
    {
        return DB::table('candidate')
                ->join('user','candidate.id_candidate', '=', 'user.id_user')
                ->get();
    }

    public function getCandidate($id)
    {
        return DB::table('candidate')
                ->join('user','candidate.id_candidate', '=', 'user.id_user')
                ->where('id_candidate' ,$id)
                ->first();
    }

    public function findCandidate($email)
    {
        return DB::table('candidate')
                        ->where('email', 'LIKE' ,$email)   
                        ->first();
    }


    //admin
    public function addCandidate($data)
    {
        return DB::table('candidate')
                ->insert($data);
    }

    //admin
    public function editCandidate($data, $id)
    {
        return DB::table('candidate')
                        ->join('user','candidate.id_candidate', '=', 'user.id_user')
                        ->where('id_candidate', $id)
                        ->update($data);
    }

    //admin
    public function delCandidate($id)
    {
        return DB::table('candidate')
                        ->where('id_candidate', $id)
                        ->delete();
    }
}
