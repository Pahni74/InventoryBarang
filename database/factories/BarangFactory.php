<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Barang::class, function (Faker $faker) {
    return [
        'nama_barang' => $faker->name,
        'gambar' => '',
        'keterangan' => $faker->address,

    ];
});
