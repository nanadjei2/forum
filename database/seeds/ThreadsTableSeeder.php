<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory('App\Thread', 20)->create(['channel_id' => factory('App\Channel')->create()->id]);
        // foreach ($threads as $thread) {
        //     $reply = factory('App\Reply', 5)->create();
        // }
        $threads->each(function($thread){
             $reply = factory('App\Reply', 5)->create(['thread_id' => $thread->id]);
         });
    }
}
