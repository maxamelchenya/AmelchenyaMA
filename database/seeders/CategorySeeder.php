<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Золотые',
            'Серебрянные',
            'Медные',
            'Военные',
            'Необычные',
            'Игровые',
            'Коллекционные',
            'Памятные',
            'Прочее',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([    
                'name' => $category,
            ]);
        };
    }
}
