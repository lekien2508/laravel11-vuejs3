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
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'user2',
            'name' => 'Khách',
            'email' => 'khach@gmail.com',
            'password' => Hash::make('khach'),
            'department_id' => '1',
            'status_id' => '2'
        ]);
    }
}
