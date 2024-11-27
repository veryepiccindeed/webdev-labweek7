<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Create 10 fake users
       for ($i = 0; $i < 10; $i++) {
           User::create([
               'name' => $faker->name,
               'email' => $faker->unique()->safeEmail,
               'password' => 'password', // Use a default password
               'role' => $faker->randomElement(['admin', 'librarian', 'lecturer', 'student']), // Random role
           ]);
       }
    }
}
