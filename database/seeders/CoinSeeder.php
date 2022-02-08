<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CoinSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $conditions = [
            'Новое',
            'БУ',
        ];

        foreach (range(1,120) as $index) {

            $createdAt = date('Y-m-d H:i:s', rand(1602799942, 1637014342));
            DB::table('coins')->insert([
                'user_id' => $faker->numberBetween(1, 8),
                'category_id' => $faker->numberBetween(1, 8),
                'country_id' => $faker->numberBetween(1, 14),
                'name' => $faker->word(),
                'description' => json_decode(file_get_contents('https://fish-text.ru/get?format=json&number=1'), true)['text'],
                'price' => $faker->randomFloat(2, 10, 1000),
                'condition' => $index / 2 == 0 ? $conditions[0] : $conditions[1],
                'year' => rand(1000, 2000),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        };
    }
}
