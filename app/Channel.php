<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    // Override the route key for fetching records which is ID into SLUG
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Threads that belongs to a particular channel
    public function threads()
    {
        return $this->hasMany(Thread::class, 'channel_id');
    }
}
