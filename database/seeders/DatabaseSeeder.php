<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        foreach (range(1, 50) as $index) {

            DB::table('products')->insert([
                'name' => $faker->name,
                'description' => Str::random(100),
                'image' => 'image.jpg',
                'price' => rand(1000, 1000000),
                'stock' => rand(1, 100),
                'slug' => Str::slug($faker->name),
                'weight' => rand(1, 100)
            ]);
        }
    }
}
