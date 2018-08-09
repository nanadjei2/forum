<?php 

namespace App\Traits;

trait RecordActivity 
{
    /**
     * This method will automatically be fired in every model which implements it.
     * adding the keyword *boot* to the trait name as function name for example:bootRecordActivity
     * When implemented in a model it looks for the *boot* keyword and does what is in there when on
     * runtime as soon as this trait is called.
     * @return [type] [description]
     */
    protected static function bootRecordActivity() 
    {
        if(auth()->guest()) return;
        foreach(static::getActivitiesToRecord() as $event) { // $event = 'created' or what event
            static::$event(function($model) use ($event){ // $model is the Eloquent model in which this triat is been implemented
                return $model->recordActivity($event);
            });    
        }
    }
    protected static function getActivitiesToRecord()
    {
        return ['created']; // created
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