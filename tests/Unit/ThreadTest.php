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
}
