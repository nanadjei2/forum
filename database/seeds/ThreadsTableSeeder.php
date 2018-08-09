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
        \App\Thread::flushEventListeners();
        $threads = factory('App\Thread', 20)->create(['channel_id' => factory('App\Channel')->create()->id]);
        // foreach ($threads as $thread) {
        //     $reply = factory('App\Reply', 5)->create();
        // }
        $threads->each(function($thread){
             $reply = factory('App\Reply', 5)->create(['thread_id' => $thread->id]);
             $activity = factory('App\Activity')->create(['user_id' => $thread->user_id, 'subject_id' => $thread->id, 'subject_type' => get_class($thread)]);
         });
    }
}
