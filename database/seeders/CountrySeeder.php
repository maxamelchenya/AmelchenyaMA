<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            'Англия',
            'США',
            'СССР',
            'Россия',
            'Германия',
            'Австрия',
            'Чехия',
            'Китай',
            'Япония',
            'Польша',
            'Литва',
            'Италия',
            'Греция',
            'Бразилия',
            'Прочее',
        ];  

        foreach ($countries as $country) {
            DB::table('countries')->insert([    
                'name' => $country,
            ]);
        };
    }
}
