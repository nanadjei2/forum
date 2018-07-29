<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id'	=>	factory('App\User')->create()->id,
        'thread_id'	=>	factory('App\Thread')->create()->id,
        'body'		=>	$faker->paragraph
    ];
});
