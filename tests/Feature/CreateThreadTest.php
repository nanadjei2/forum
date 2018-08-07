<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;
     /**
     * A guest may not create thread
     *  @test
     *  Middleware
     * @return void
     */
      public function unauthenticated_user_may_not_create_thread()
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
    public function authenticated_user_can_create_a_new_thread()
    {
        // Given we hava a signed in user
        $this->signIn();
        // Then we hit the endpoint to create a new thread
        $thread = create('App\Thread'); // Create in memory
        $response = $this->post('/threads', $thread->toArray());
        // Then, when we visit the thread page.
        //dd($response->headers->get('Location'));
        $visitThread = $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);
        // We should see the new thread
    }

    /**
     * Title, Body validation errors
     *  @test
     * @return void
     */   
    public function a_thread_requires_title_body()
    {
       $this->publishThread(['title' => null, 'body' => null])
            ->assertSessionHasErrors('title')
            ->assertSessionHasErrors('body');
    }

     /**
     * Title, Body validation errors
     *  @test
     * @return void
     */   
     public function a_channel_requires_a_valid_channel_id()
     {
         $channel = factory('App\Channel', 2)->create();
         $this->publishThread(['channel_id' => null ?:98797])->assertSessionHasErrors('channel_id');
     }

    // *********************** Helper Methods ****************
    public function publishThread(array $overrides)
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $overrides);
        return $this->post(route('threads.store'), $thread->toArray());
    }

     /**
     * A user can delete theads
     *  @test
     * @return void
     */   
    public function a_user_can_delete_threads()
    {
        // Given we have a signed in user
        $this->signIn();
        // When the user hits an endpoint to delete a thread
        $thread = create('App\Thread'); // Create a thread
        $reply = create('App\Reply', ['thread_id' => $thread->id]); // Create a reply associated with the thread.
        $response = $this->json('DELETE', $thread->path());
        // There thread should be deleted from the database.
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]); // Delete the thread from the DB
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]); // Delete the replies associated with the thread as well.
        $response->assertStatus(204);
    }
}
