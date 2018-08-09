<?php

use Faker\Generator as Faker;

$factory->define(\App\Activity::class, function (Faker $faker) {
    return [
        'type'  =>  'created_'. $faker->randomElement(['thread', 'reply']),
        'user_id' => '',
        'subject_id' => '',
        'subject_type' => ''
    ];
});
