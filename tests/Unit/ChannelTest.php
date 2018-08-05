<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Assert that a channel has many threads.
     *@test
     * @return void
     */
    public function a_channel_may_contain_threads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
