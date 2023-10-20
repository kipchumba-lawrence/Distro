<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CocaColaProductsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 150) as $index) {
            DB::table('products')->insert([
                'name' => $faker->word, // Replace with appropriate product names
                'description' => $faker->sentence, // Replace with descriptionsß
                'category_id' => $faker->randomFloat(0,1, 11), // Replace with the category ID for Coca-Cola products
                'packaging' => $faker->randomElement(['glass', 'plastic', 'can', 'carton']),
                'price' => $faker->randomFloat(2, 1, 10),
                'quantity' => $faker->numberBetween(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
