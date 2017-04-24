<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
		'name','email','address','company','phone','group_id', 'created_at', 'updated_at', 'photo', 'user_id'
	];

    public function group(){
    	return $this -> belongsTo('App\Group');
    }

    public function user(){
    	// alternative to using namespace like 'App\User', we can use the model.
    	return $this -> belongsTo(User::class);
    }
}
