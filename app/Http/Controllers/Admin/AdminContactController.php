<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;


class AdminContactController extends Controller
{
    public function __construct(Contact $mcontact )
    {
    	$this->mcontact = $mcontact;
    }

    public function index()
    {
    	$contacts = $this->mcontact->getContacts();
    	return view('admin.contact.index',compact('contacts'));
    }

    public function del($id)
    {
        $result = $this->mcontact->delContact($id);
        return redirect()->route('admin.contact.index')->with('msg', 'Deleted successfully.');
    }

}
