<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

      /**
     * Get the route key name for Laravel
     * This means laravel will use the name attribute in of the
     * record to pull information instead of Ids. Hence when a username is 
     * spit in the url the respective recored will be be pull and performed the neccessary function. 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

     /**
     * A channel has many threads
     * @return \Illuminate\Eloquent\Relationship\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class, 'channel_id');
    }
}
