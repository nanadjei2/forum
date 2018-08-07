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
}
