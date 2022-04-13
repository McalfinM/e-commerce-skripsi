<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Date;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('categories')->insert([
            'name' => 'Alat Tulis',
        ]);
        DB::table('categories')->insert([
            'name' => 'HVS',
        ]);
        DB::table('categories')->insert([
            'name' => 'Tempat Pensil',
        ]);
        DB::table('categories')->insert([
            'name' => 'Buku',
        ]);
        DB::table('categories')->insert([
            'name' => 'Tas',
        ]);
        DB::table('categories')->insert([
            'name' => 'Alat Kantor Lainnya',
        ]);
        DB::table('categories')->insert([
            'name' => 'Perlengkapan Printer',
        ]);
        foreach (range(1, 50) as $index) {

            DB::table('products')->insert([
                'name' => $faker->name,
                'description' => Str::random(100),
                'image' => 'image.jpg',
                'price' => rand(1000, 1000000),
                'stock' => rand(1, 100),
                'category_id' => rand(1, 7),
                'slug' => Str::slug($faker->name),
                'pack_true' => rand(0, 1)
            ]);
        }


        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'google2fa_secret' => null
        ]);
        DB::table('users')->insert([
            'username' => 'company',
            'password' => bcrypt('password'),
            'email' => 'company@gmail.com',
            'role' => 'Company',
            'google2fa_secret' => null
        ]);

        DB::table('profiles')->insert([
            'user_id' => 2,
            'phone' => '0895775487',
            'name' => 'admin',
            'pic_name' => 'admin',
            'image' => 'image.jpg',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('profiles')->insert([
            'user_id' => 1,
            'phone' => '0895775487',
            'name' => 'company',
            'pic_name' => 'company',
            'image' => 'image.jpg'
        ]);
    }
}
