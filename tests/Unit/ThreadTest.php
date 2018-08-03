<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;
	function setUp()
	{
		parent::setUp();
		$this->thread = factory('App\Thread')->create();
	}
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_thread_has_a_creator()
    {
    	$this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /**
     *  @test
     * @return void
     */
    public function a_thread_can_add_a_reply()
    {
    	$addReply = $this->thread->addReply([
    			'user_id'	=>	1,
    			'body'		=>	'Foobar'
    		]);
    	$this->assertCount(1, $this->thread->replies);
    }

      /**
     * A guest may not create thread
     *  @test
     * @return void
     */
      public function an_unauthenticated_user_may_not_create_thread()
      {
          $this->expectException('Illuminate\Auth\AuthenticationException');
          $thread = factory('App\Thread')->raw(); // Produces an array response instead of an object
          $this->post('/threads', $thread); // Hence there is no need for $thread->toArray();
      }

    /**
     * Authenticated user can create a thread
     *  @test
     * @return void
     */
    public function an_authenticated_user_can_create_a_thread()
    {
    	// Given we hava a signed in user
    	$this->signIn();
    	// Then we hit the endpoint to create a new thread
        $thread = make('App\Thread'); // Create in memory
        $this->post('/threads', $thread->toArray());
    	// Then, when we visit the thread page.
        $visitThread = $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);
    	// We should see the new thread
    }
}
