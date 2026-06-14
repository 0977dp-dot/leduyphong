<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    for ($i = 1; $i <= 5; $i++) {

        $fullname = fake()->name();

        DB::table('users')->insert([
            'fullname' => $fullname,
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '123456', 
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'gender' => fake()->numberBetween(0, 2),
            'birthday' => fake()->date(),
            'role' => fake()->numberBetween(1, 2),
            'status' => fake()->numberBetween(0, 1),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
         }
    }
}