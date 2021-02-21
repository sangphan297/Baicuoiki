<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
	public function __construct(Contact $mcontact, DataTreeController $cdata_tree)
	{
		$this->mcontact   = $mcontact;
    $this->cdata_tree = $cdata_tree;
	}


  public function contact()
  {
    $cats = $this->cdata_tree->cat();
   	return view('recruitment.contact.contact',compact('cats'));
  }

  public function postContact(Request $request)
  {
   $name    = $request->name;
   $email   = $request->email;
   $phone   = $request->phone;
   $subject = $request->subject;
   $message = $request->message;

   $data = [
      "name"    => $name,
      "email"   => $email,
      "phone"   => $phone,
      "subject" => $subject,
      "message" => $message,
  ];

  $result = $this->mcontact->addContact($data);
  return redirect()->route('recruitment.contact.contact')->with('msg', 'Submitted successfully!');
  }
}
