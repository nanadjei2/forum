<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
	use DatabaseMigrations;
	 /**
     * A user can participate in a forum
     * @test
     * @return void
     */
    public function unauthenticated_users_may_not_add_replies() {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	// Given we have a reply.
    	$reply = factory('App\Reply')->make();
    	// The user submits a reply.
    	// $this->post('threads/'.$thread->id.'/replies', $reply->toArray()); also works
    	$this->post('threads/some-channel/1/replies', $reply->toArray());
    }

    /**
     * A user can participate in a forum
     * @test
     * @return void
     */
    public function authenticated_user_may_participate_in_forum_threads()
    {
    	// Given we have an authenticated user.
    	$user = factory('App\User')->create();
    	$this->be($user);
    	// Given we have a thread.
    	$thread = factory('App\Thread')->create();
    	// Given we have a reply.
    	$reply = factory('App\Reply')->make();
    	// The user submits a reply.
    	// $this->post('threads/'.$thread->id.'/replies', $reply->toArray()); also works
    	$this->post($thread->path().'/replies', $reply->toArray());
    	$this->get($thread->path())->assertSee($reply->body);
    }

    /**
     * Validation a reply
     * @test
     * @return void
     */
    public function a_reply_requires_thread_id_user_id_body()
    {
        $this->withExceptionHandling()->signIn();
        // Given we have a thread.
        $thread = factory('App\Thread')->create();
        // Given we have a reply.

        //$reply = factory('App\Reply')->make(['thread_id' => null ?: 8343, 'user_id' => null ?: 3458, 'body' =>  null]); works
        // $this->post($thread->path().'/replies', $reply->toArray())
        //         ->assertSessionHasErrors('thread_id')
        //         ->assertSessionHasErrors('user_id')
        //         ->assertSessionHasErrors('body');

        $reply = factory('App\Reply')->make(['body' =>  null]); 
        $this->post($thread->path().'/replies', $reply->toArray())
                ->assertSessionHasErrors('body');
    }
}
