<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('Matkhau123'),
                'phone' => '1234567890',
                'address' => 'Admin Address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'role' => 'customer',
                'password' => Hash::make('Matkhau123'),
                'phone' => '0987654321',
                'address' => 'User Address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
