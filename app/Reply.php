<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
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
        $attributes = ['user_id' => auth()->id()];
        if(! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * Chech whether auth user has already favorited the reply
     * @return boolean 
     */
    public function isFavorited()
    {
        // For the perpose of eager loading.
        // return $this->favorites()->where('user_id', auth()->id())->exists();
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

     // Custom FavoritesCount 
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
