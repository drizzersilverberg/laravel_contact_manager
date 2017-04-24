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
            'email' => ['required', 'email'],
            'photo' => ['mimes:jpg,jpeg,png,gif,bmp']
        ];

    private $upload_dir = '/public/uploads';

    private function getRequest(Request $request){

        // get all request data
        $data = $request->all();

        // check the photo if it is null
        if($request->hasFile('photo')){
            // get photo filename
            $photo          = $request -> file('photo');
            $fileName       = $photo ->getClientOriginalName();
            // set path or destination 
            $destination    = $this->upload_dir;
            // move photo to destination
            $photo -> move($destination, $fileName );

            // assign photo to request data
            $data['photo'] = $fileName;
        }

        return $data;
    }

    private function removePhoto($photo){
        if(!empty($photo)){
            $file_path = $this->upload_dir . '/' . $photo;

            if(file_exists($file_path)) unlink($file_path);
        }
    }

    public function __construct(){
        // authenticate
        $this -> middleware('auth');
        $this -> upload_dir = base_path() . '/' . $this->upload_dir;
    }

    public function index(Request $request){
    	
        $contacts = Contact::where(function($query) use ($request){
            if($group_id = ($request->get('group_id'))){
                $query->where('group_id', $group_id);
            }
            if (($term = $request -> get("term"))){
                $keywords = '%'.$term.'%';
                $query->orWhere('name', 'LIKE', $keywords);
                $query->orWhere('company', 'LIKE', $keywords);
                $query->orWhere('email', 'LIKE', $keywords);
            }
        })
        -> orderBy('id', 'desc')
        -> paginate($this->limit);

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
        
        // request data
        $data = $this->getRequest($request);

        // create to database
        Contact::create($data);

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
        $oldPhoto = $contact->photo;

        // request data
        $data = $this->getRequest($request);

        // update data 
        $contact->update($data);

        if($oldPhoto !== $contact->photo){
            $this->removePhoto($oldPhoto);
        }

        // redirect
        return redirect('contacts')->with('message','Contact Updated!');

    }

    public function destroy($id){
        // find contact by id
        $contact = Contact::find($id);
        // delete contact
        $contact->delete();

        // remove the related photo
        $this -> removePhoto($contact);

        // redirect
        return redirect('contacts')->with('message','Contact Deleted!');
    }

    public function autocomplete(Request $request){

        if($request->ajax()){

            return Contact::select(['id','name as value'])->where(function($query) use ($request){
                if($group_id = ($request->get('group_id'))){
                    $query->where('group_id', $group_id);
                }
                if (($term = $request -> get("term"))){
                    $keywords = '%'.$term.'%';
                    $query->orWhere('name', 'LIKE', $keywords);
                    $query->orWhere('company', 'LIKE', $keywords);
                    $query->orWhere('email', 'LIKE', $keywords);
                }
            })
            -> orderBy('name', 'asc')
            -> take(5)
            -> get();
        }
    }
}
