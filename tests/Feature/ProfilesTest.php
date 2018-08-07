<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to see if a user can visit his/her profile.
     * @test
     * @return void
     */
    public function a_user_has_profile()
    {
        // Given we have a user.
        $user = create('App\User');
        // And he is signin.
        $this->signIn();
        // When he hits the profile endpoin he should see his name.
        //$this->get("/profiles/{ $user->name }")->assertSee($user->name);
        $this->get(route('profiles.show', ['user' => $user->name]))->assertSee($user->name);
    }

     /**
     * Test view all threads of the user.
     * @test
     * @return void
     */
    public function profile_display_all_threads_created_by_the_associated_user()
    {
        // And he is signin.
        $this->signIn();
        // Given we have a user.
        $user = create('App\User');
        $thread = create('App\Thread', ['user_id' => $user->id]);
        // When he hits the profile endpoin he should see his name.
        $this->get(route('profiles.show', ['user' => $user->name]))
                ->assertSee($thread->title)
                ->assertSee($thread->body); 
    }
}
