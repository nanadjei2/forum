<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    // Validation rules when a user is replying to a thread
    public static $rules = [
        'body'      =>  'required'
    ];

    // The user who created the reply
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Favourated replies
     * @return  \Illuminate\Database\Eloquent\Relationship\morphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Automatically apply favorites.
     * @return array of data stored in database
     */
    public function favorite() 
    {
        return $this->favorites()->create(['user_id' => auth()->id()]);
    }
}
