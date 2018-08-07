<?php

namespace App;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;

    protected $guarded = [];
    protected $with = ['owner', 'favorites']; // For eagerloadings

    // Validation rules when a user is replying to a thread
    public static $rules = [
        'body'      =>  'required'
    ];

    // The user who created the reply
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
