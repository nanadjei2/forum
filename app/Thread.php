<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	// Return the full path to the resource
    public function path() 
    {
    	return url('/') . '/threads/' . $this->id;
    }

    // Thread replies
    public function replies()
    {
    	return $this->hasMany(Reply::class, 'thread_id');
    }
}
