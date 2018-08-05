<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    // The user who created the reply
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Validation rules when a user is replying to a thread
    public static $rules = [
        'body'      =>  'required'
    ];
}
