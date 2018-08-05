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
     * A thread uri should have a channel slug and thread id.
     * @test
     * @return void
     */
    public function a_thread_can_make_a_string_path()
    {
        $thread = create('App\Thread');
        $this->assertEquals(url('/') . "/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
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
     * Guest may not create thread
     *  @test
     * @return void
     */
    public function a_guest_may_not_see_the_create_thread_page() 
    {
        $this->withExceptionHandling()->get(route('threads.create'))->assertRedirect('/login');
    }
    /**
     * A thread belongs to a channel
     *  @test
     * @return void
     */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Thread');
        $this->assertInstanceOf('App\Channel', $thread->channel);
    }
}
