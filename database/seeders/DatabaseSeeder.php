<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'HTh',
            'email' => 'hilmanthoriq31@gmail.com',
            'password' => bcrypt('hilmanthoriq31')
        ]);

        User::factory()->create([
            'name' => 'admin12',
            'email' => 'testadmin12@gmail.com',
            'password' => bcrypt('12admin123')
        ]);
    }
}
