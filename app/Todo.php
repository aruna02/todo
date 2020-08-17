<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Todo extends Model
{
    //
     protected $fillable = [

    	'description',
    	'status',
    	'scheduled_date',
    	'user_id'

    ];

	public function userInfo(){
	        return $this->belongsTo(User::class,'user_id','id');
	    }

}
