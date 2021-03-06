<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// import group model
use App\Group;

class GroupsController extends Controller
{
    public function store(Request $request){
    	$this -> validate($request, [
    		// 'name' => ['required','unique:groups'] // this is for lower version of laravel
    		'name' => 'required|unique:groups'
    	]);

    	return Group::create($request->all());

    	// return redirect
    }
}
