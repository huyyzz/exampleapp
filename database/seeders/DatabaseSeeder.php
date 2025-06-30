<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
       $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
        ]);

        DB::table('categories')->insert([
            'id' => '2',
            'name' => 'Quần',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'id' => '3',
            'name' => 'Áo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

}



