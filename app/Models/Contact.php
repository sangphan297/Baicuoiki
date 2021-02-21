<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    use HasFactory;
    protected $table = "contact";
    protected $primaryKey = "id_contact";


    public function getContacts()
    {
        return DB::table('contact')
                    ->get();
    }

    //admin
    public function addContact($data)
    {
        return DB::table('contact')->insert($data);
    }

    //admin
    public function delContact($id)
    {
        return DB::table('contact')
                        ->where('id_contact', $id)
                        ->delete();
    }

}
