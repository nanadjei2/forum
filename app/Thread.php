<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	// protected $guarded = [];
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

    //	An instance of a User who created a thread
    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    // Add a reply to a thread
    public function addReply(array $reply)
    {
    	return $this->replies()->create($reply);
    }
}
