<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * guest users can not favorite anything.
     * @test
     * Middleware
     * @return void
     */
    public function guests_can_not_favorite_anything()
    {
        // If a user tries to favorite, send them to login
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /**
     * authenticated users can favourate a reply.
     * @test
     * @return void
     */
    public function authenticated_user_can_favorite_a_reply()
    {
        // signin a user
        $this->signin();
        // When a reply is created
        $reply = create('App\Reply');
        // Then the reply is posted to a favourate endpoint
        $this->post(route('reply.favorites', $reply->id));
        // If it does not exist already then save in database
        $this->assertCount(1, $reply->favorites);
    }

    /**
     * An auth user may not favorite a reply more than once
     * @test
     * @return void
     */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
         // signin a user
        $this->signin();
        // When a reply is created
        $reply = create('App\Reply');
        try {
            // Then the reply is posted to a favourate endpoint
            $this->post(route('reply.favorites', $reply->id));
            // Then the reply is posted to a favourate endpoint AGAIN
            $this->post(route('reply.favorites', $reply->id));
        } catch (\Exception $e) {
            $this->fail('You are not expected to favorite a reply twice');
        }
        // If it does not exist already then save in database
        $this->assertCount(1, $reply->favorites);
    }
}
