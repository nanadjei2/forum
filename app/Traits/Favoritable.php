<?php  

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Favoritable
{

    /**
     * Favourated replies
     * @return  \Illuminate\Database\Eloquent\Relationship\morphMany
     */
    public function favorites()
    {
        return $this->morphMany(\App\Favorite::class, 'favorited');
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