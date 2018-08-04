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
}
