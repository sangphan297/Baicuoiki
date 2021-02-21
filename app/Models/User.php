<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
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
    protected $table = "user";
    protected $primaryKey = "id_user";

    public function getUsers()
    {
        return DB::table('user')->paginate(5);
    }

    public function getAdmins()
    {
        return DB::table('user')
                    ->where('id_info', 0)
                    ->paginate(5);
    }

    public function getRecruiters()
    {
        return DB::table('user')
                    ->where('id_info', 1)
                    ->paginate(5);
    }

    public function getCandidates()
    {
        return DB::table('user')
                    ->where('id_info', 2)
                    ->paginate(5);
    }

    public function getUser($id)
    {
        return $this->findOrFail($id);
    }


    public function findUser($email)
    {
        return DB::table('user')
                        ->where('email', 'LIKE' ,$email)   
                        ->first();
    }

    public function findID()
    {
        return DB::table('user')
                        ->max('id_user');
    }

    //admin
    public function addUser($data)
    {
        return DB::table('user')->insert($data);
    }

    //admin
    public function editUser($data, $id)
    {
        return DB::table('user')
                        ->where('id_user', $id)
                        ->update($data);
    }

    //admin
    public function delUser($id)
    {
        return DB::table('user')
                        ->where('id_user', $id)
                        ->delete();
    }
}
