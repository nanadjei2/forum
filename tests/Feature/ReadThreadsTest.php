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
        $this->channel = $channel = factory('App\Channel')->create();
	}
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_user_can_view_all_threads()
    {
     	$response = $this->get(route('threads.index'));
        $response->assertSee($this->thread->title);
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get(route('threads.show', [$this->channel->id, $this->thread->id]));
        $response->assertSee($this->thread->title);
    }

    /**
     * A user can view replies of a particular resource
     * @test
     * @return void
     */
   public function a_user_can_read_replies_that_are_associated_with_a_thread()
   {
   		$reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
   		$response = $this->get(route('threads.show', [$this->channel->id, $this->thread->id]));
   		$response->assertSee($reply->body);
   }

   /**
     * A user can filter through a channel when its tag page is visited
     * @test
     * @return void
     */
   public function a_user_can_filter_through_a_channel_when_its_tag_is_visited()
   {
        $this->signIn();
       $channel = create('App\Channel');
       $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
       $threadNotInChannel = create('App\Thread');
       $this->get(route('threads.filterByChannel', $channel->slug))
            ->assertSee($threadInChannel->title)->assertDontSee($threadNotInChannel->title);
   }

    /**
     * A user can filter through a thread by any username
     * @test
     * @return void
     */
    public function a_user_can_filter_threads_by_any_username()
    {
      $user = $this->signIn(create('App\User', ['name' => 'JohnDoe']));
      $threadByJohn = create('App\Thread', ['user_id' => auth()->id(), 'channel_id' => 3]);
      $threadNotByJohn = create('App\Thread', ['channel_id' => 3]);
      $this->get('threads?by=JohnDoe')->assertSee($threadByJohn->title)->assertDontSee($threadNotByJohn->title);
    }
}
