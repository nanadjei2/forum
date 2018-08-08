<?php

namespace Tests\Unit;

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
    }
}
