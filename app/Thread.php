<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	protected $guarded = [];
    protected $with = ['channel', 'creator'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });
    }

	// Return the full path to the resource
    public static $rules = [
            'title' => 'required',
            'body'  =>  'required',
            'channel_id'    =>  'required|exists:channels,id'
        ];
    public function path() 
    {
        return url('/')."/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * Thread replies
     * @return \Illuminate\Database\Eloquent\Relationship\HasMany
     */
    public function replies()
    {
    	return $this->hasMany(Reply::class, 'thread_id');
    }

    /**
     * A thread belongs to a creator:
     * Return a instance of the user who created the thread
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    /**
    * Add a thread reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addReply(array $reply)
    {
    	return $this->replies()->create($reply);
    }

    // Thread channel
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    // Custome replyCountAttribute to count replies
    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }
}
