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
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'',
            'password'=> Hash::make('123456'),
            'role'=>'admin'
        ]);

        DB::table('users')->insert([
            'name'=>'Customer',
            'email'=>'customer@gmail.com',
            'phone'=>'',
            'password'=> Hash::make('123456'),
            'role'=>'customer'
        ]);


        DB::table('brands')->insert([
            'id' => '1',
            'name' => 'Adidas'
        ]);
        DB::table('brands')->insert([
            'id' => '2',
            'name' => 'Nike'
        ]);
        DB::table('brands')->insert([
            'id' => '3',
            'name' => 'Gucci'
        ]);
        DB::table('brands')->insert([
            'id' => '4',
            'name' => 'Nike'
        ]);
        DB::table('brands')->insert([
            'id' => '5',
            'name' => 'Versace'
        ]);
        DB::table('brands')->insert([
            'id' => '6',
            'name' => 'No brand'
        ]);


        DB::table('categories')->insert([
            'id' => '1',
            'name' => 'Quần'
        ]);
        DB::table('categories')->insert([
            'id' => '2',
            'name' => 'Áo'
        ]);

    }

}



