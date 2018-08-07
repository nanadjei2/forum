<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the route key name for Laravel
     * This means laravel will use the name attribute in of the
     * record to pull information instead of Ids. Hence when a username is 
     * spit in the url the respective recored will be be pull and performed the neccessary function. 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * A user can have multiple threads
     * @return \Illuminate\Eloquent\Relationship\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class, 'user_id');
    }
}
