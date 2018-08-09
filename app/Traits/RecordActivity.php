<?php 

namespace App\Traits;

trait RecordActivity 
{
	protected function recordActivity($event, $thread)
        {
            return \App\Activity::create([
                'type' => $event.'_'. strtolower((new \ReflectionClass($thread))->getShortName()), // Instead of App\Thread -> Thread
                'user_id' => auth()->id(), 
                'subject_id' => $thread->id,
                'subject_type' => get_class($thread) // 'App\Thread' 
            ]);
        }
}