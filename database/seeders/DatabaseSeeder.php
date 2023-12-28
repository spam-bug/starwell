<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'name' => 'Admin User',
             'username' => 'admin',
             'email' => 'admin@example.com',
             'password' => Hash::make('qweqweqwe'),
             'account_type' => 'admin',
         ]);

        \App\Models\User::create([
            'name' => 'Demo User',
            'username' => 'demo',
            'email' => 'demo@example.com',
            'password' => Hash::make('qweqweqwe'),
            'account_type' => 'customer',
        ]);

         $this->call([
            AccommodationSeeder::class,
         ]);
    }
}
