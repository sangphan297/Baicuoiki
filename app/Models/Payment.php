<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payment";
    protected $primaryKey = "id_payment";


    public function getPayments()
    {
        return DB::table('payment')
                    ->join('recruiter', 'payment.id_recruiter', '=', 'recruiter.id_recruiter')
                    ->orderBy('id_payment', 'desc')
                    ->paginate(10);
    }

    public function getPayments_Recruiter($id_recruiter)
    {
        return DB::table('payment')
                    ->join('recruiter', 'payment.id_recruiter', '=', 'recruiter.id_recruiter')
                    ->where('payment.id_recruiter', $id_recruiter)
                    ->orderBy('id_payment', 'desc')
                    ->paginate(10);
    }

    public function getTotal()
    {
        return DB::table('payment')
                    ->sum('amount');
    }

    public function getTotal_Recruiter($id_recruiter)
    {
        return DB::table('payment')
                    ->where('payment.id_recruiter', $id_recruiter)
                    ->sum('amount');
    }


    //admin
    public function addPayment($data)
    {
        return DB::table('payment')->insert($data);
    }

    //admin
    public function delPayment($id)
    {
        return DB::table('payment')
                    ->where('id_payment', $id)
                    ->delete();
    }

}
