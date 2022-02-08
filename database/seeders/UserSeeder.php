<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,100) as $index) {
            $createdAt = date('Y-m-d H:i:s', rand(1202799942, 1637014342));

            DB::table('users')->insert([
                'name' => $faker->firstName(),
                'role_id' => '1',
                'email' => $faker->email(),
                'password' => Hash::make('admin'),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        };
    }
}
