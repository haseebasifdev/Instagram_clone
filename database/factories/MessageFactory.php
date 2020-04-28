<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'to' => 2,
        'from' => 1,
        'message' => "Helo to the future kha hn aap ahkbfa"
    ];
});
