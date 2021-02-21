<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function __construct(Payment $mpayment )
    {
    	$this->mpayment = $mpayment;
    }

    public function index()
    {
    	$payments = $this->mpayment->getPayments();
        $total    = $this->mpayment->getTotal();
    	return view('admin.payment.index',compact('payments','total'));
    }

    public function del($id)
    {
        $result = $this->mpayment->delPayment($id);
        return redirect()->route('admin.payment.index')->with('msg', 'Deleted successfully.');
    }

}
