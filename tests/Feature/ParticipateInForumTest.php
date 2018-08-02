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
    	$thread = factory('App\Thread')->create();
    	// Given we have a reply.
    	$reply = factory('App\Reply')->create();
    	// The user submits a reply.
    	// $this->post('threads/'.$thread->id.'/replies', $reply->toArray()); also works
    	$this->post($thread->path().'/replies', $reply->toArray());
    }
    /**
     * A user can participate in a forum
     * @test
     * @return void
     */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
    	// Given we have an authenticated user.
    	$user = factory('App\User')->create();
    	$this->be($user);
    	// Given we have a thread.
    	$thread = factory('App\Thread')->create();
    	// Given we have a reply.
    	$reply = factory('App\Reply')->create();
    	// The user submits a reply.
    	// $this->post('threads/'.$thread->id.'/replies', $reply->toArray()); also works
    	$this->post($thread->path().'/replies', $reply->toArray());
    	$this->get($thread->path())->assertSee($reply->body);
    }
}
