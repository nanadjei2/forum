<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
    	'user_id'	=>	factory('App\User')->create()->id,
        'channel_id'    =>  factory('App\Channel')->create()->id,
        'title'	=>	$faker->sentence,
        'body'	=>	$faker->paragraph
    ];
});
