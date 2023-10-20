<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Soda',
            'Juice',
            'Energy Drink',
            'Tea',
            'Coffee',
            'Snacks',
            'Candy',
            'Sports Drink',
            'Dietary Supplements',
        ];

        foreach ($categories as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
