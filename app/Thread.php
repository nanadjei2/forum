<?php

namespace App;

use App\Activity;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordActivity;
    
	protected $guarded = [];
    protected $with = ['channel'];

    protected static function boot()
    {
        parent::boot();
        // In this case you can disable these queries by doing:
        // $thread = Thread::withoutGlobalScopes()->first();
        static::addGlobalScope('creator', function($builder) {
            return $builder->with('creator');
        });
        static::addGlobalScope('replyCount', function($builder) {
            return $builder->withCount('replies');
        });
        static::deleting(function($thread) {
            return $thread->replies()->delete();
        });
        static::created(function($thread) {
            return $thread->recordActivity('created', $thread);
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

     /**
     * A thread belongsTo a channel
     * @return \Illuminate\Eloquent\Relationship\HasMany
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    // Custom replyCountAttribute to count replies
    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }
}
