<?php

namespace Tests\Unit;

use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * It records activity when a thread is created.
     * @test
     * @return void
     */
    public function it_records_activities_when_a_thread_is_created()
    {
        // Given we have a signed in user
        $this->signIn();
        // When the user create a thread
        $thread = create('App\Thread');
        // We expect to see in database these attributes
        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(), 
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread'  
        ]);
        $activity = \App\Activity::first();
        //$this->assertEquals($thread->activity->subject->id, $activity->subject_id);
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /**
     * It records activity when a reply is created.
     * @test
     * @return void
     */
    public function it_records_activities_when_a_reply_is_created($value='')
    {
        // Given we have a signed in user
        $this->signIn();
        // When the user create a thread
        $thread = Create('App\Thread');
        $reply = create('App\Reply', ['thread_id' => $thread->id]);
        // We expect to see in database these attributes
        $this->assertEquals(2, Activity::count());
        // $this->assertDatabaseHas('activities', [
        //     'type' => 'created_reply',
        //     'user_id' => auth()->id(), 
        //     'subject_id' => $reply->id,
        //     'subject_type' => 'App\Reply'  
        // ]);
    }
}
