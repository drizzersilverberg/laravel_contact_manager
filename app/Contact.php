<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
		'name','email','address','company','phone','group_id', 'created_at', 'updated_at'
	];

    public function group(){
    	return $this -> belongsTo('App\Group');
    }
}
