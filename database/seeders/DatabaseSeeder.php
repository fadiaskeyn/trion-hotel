<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Visitor::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'owner',
            'email' => 'owner@mail.com',
            'password' => 'owner123',
            'role' => 'owner',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'resepsionis',
            'email' => 'resepsionis@mail.com',
            'password' => 'resepsionis123',
            'role' => 'resepsionis',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'bendahara',
            'email' => 'bendahara@mail.com',
            'password' => 'bendahara123',
            'role' => 'bendahara',
        ]);
    }
}
