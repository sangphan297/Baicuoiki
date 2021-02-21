<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class Recruiter extends Authenticatable
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
    protected $table = "recruiter";
    protected $primaryKey = "id_recruiter";

    public function getRecruiters()
    {
        return DB::table('recruiter')
                ->join('user','recruiter.id_recruiter', '=', 'user.id_user')
                ->paginate(5);
    }

    public function getAllRecruiters()
    {
        return DB::table('recruiter')
                ->join('user','recruiter.id_recruiter', '=', 'user.id_user')
                ->get();
    }

    public function getRecruiter($id)
    {
        return DB::table('recruiter')
                ->join('user','recruiter.id_recruiter', '=', 'user.id_user')
                ->where('id_recruiter',$id)
                ->first();
    }


    public function findRecruiter($email)
    {
        return DB::table('recruiter')
                        ->where('email', 'LIKE' ,$email)   
                        ->first();
    }

    //admin
    public function addRecruiter($data)
    {
        return DB::table('recruiter')->insert($data);
    }

    //admin
    public function editRecruiter($data, $id)
    {
        return DB::table('recruiter')
                        ->where('id_recruiter', $id)
                        ->update($data);
    }

    //admin
    public function delRecruiter($id)
    {
        return DB::table('recruiter')
                        ->where('id_recruiter', $id)
                        ->delete();
    }
}
