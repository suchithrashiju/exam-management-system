<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'mobile' => '1234567890',
                'address' => '123 Main St, Anytown, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'mobile' => '0987654321',
                'address' => '456 Elm St, Anytown, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'mobile' => '1112223333',
                'address' => '789 Oak St, Anytown, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob.brown@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'mobile' => '4445556666',
                'address' => '101 Pine St, Anytown, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie.davis@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'mobile' => '7778889999',
                'address' => '202 Maple St, Anytown, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
