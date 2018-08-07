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

     /**
     * A thread belongs to a user
     * @return \Illuminate\Eloquent\Relationship\HasMany
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
