<?php 

namespace App\Traits;

trait RecordActivity 
{
    // The type of activity
    protected static function getRecordEvent()
    {
        return ['created'];
    }
    /**
     * Stores a generic activity
     * @param  $event is the type of activity
     * @return \Illuminate\Eloquent\Model
     */
	protected function recordActivity($event)
        {
            // return \App\Activity::create([
            //     'type' => $event.'_'. strtolower((new \ReflectionClass($thread))->getShortName()), // Instead of App\Thread -> Thread
            //     'user_id' => auth()->id(), 
            //     'subject_id' => $thread->id,
            //     'subject_type' => get_class($thread) // 'App\Thread' 
            // ]); Works fine
            $this->activities()->create([
                'type' => $event.'_'. strtolower((new \ReflectionClass($this))->getShortName()), // Instead of App\Thread -> Thread
                'user_id' => auth()->id()
            ]);
        }
}