<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;

class ContactsController extends Controller
{
    public function index(){
    	// $contacts = Contact::all();
    	$contacts = Contact::paginate(10);
    	return view('contacts.index', compact('contacts'));
    }
}
