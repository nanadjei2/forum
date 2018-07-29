<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
	use DatabaseMigrations;
	public function setUp()
	{
		parent::setUp();
		$this->thread = $thread = factory('App\Thread')->create();
	}
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_user_can_view_all_threads()
    {
     	$response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get('/threads/'. $this->thread->id);
        $response->assertSee($this->thread->title);
    }

   public function a_user_can_read_replies_that_are_associated_with_a_thred()
   {
   		$reply = factory('App\Reply')->create();
   		$response = $this->get('/threads/'. $this->thread->id);
   		$response->assertSee($reply->body);
   }
}
