<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;
use App\Group;

class ContactsController extends Controller
{
    // set pagination limit
	private $limit = 5;

    // set rules for validate in each variables
    private $rules = [
            'name' => ['required', 'min:5'],
            'company' => ['required'],
            'email' => ['required', 'email']
        ];

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

    public function store(Request $request){
        
        

        // validate request with rules
        $this->validate($request, $this->rules);

        // create to database
        Contact::create($request->all());

        // redirect
        return redirect('contacts')->with('message','Contact Saved!');

    }

    public function edit($id){
        $groups = [];
        foreach(Group::all() as $group) {
            $groups[$group->id] = $group->name;
        }
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact','groups'));
    }

    public function update($id, Request $request){
        
        // validate request with rules
        $this->validate($request, $this->rules);

        // find data by id
        $contact = Contact::find($id);

        // update data 
        $contact->update($request->all());

        // redirect
        return redirect('contacts')->with('message','Contact Updated!');

    }
}
