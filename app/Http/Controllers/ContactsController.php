<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;
use App\Group;

class ContactsController extends Controller
{
	private $limit = 5;

    public function index(Request $request){
    	if($group_id = ($request->get('group_id'))) {
    		$contacts = Contact::where('group_id', $group_id)->paginate($this->limit);
    	}else{
    		// $contacts = Contact::all();
    		$contacts = Contact::paginate($this->limit);
    	}
    	
    	return view('contacts.index', compact('contacts'));
    }

    public function create(){
        $groups = [];
        foreach(Group::all() as $group) {
            $groups[$group->id] = $group->name;
        }
        return view("contacts.create", compact('groups'));
    }
}
