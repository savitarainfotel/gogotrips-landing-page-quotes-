<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Chintan',
            'email' => 'chintan@gogotripsus.com',
            'password' => Hash::make('Savitara@123p'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Kedar',
            'email' => 'kedar@gogotripsus.com',
            'password' => Hash::make('Savitara@123p'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'QA',
            'email' => 'qa@gogotripsus.com',
            'password' => Hash::make('Savitara@123p'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Saurabh',
            'email' => 'saurabh@savitarainfotel.com',
            'password' => Hash::make('Savitara@123p'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Jignesh',
            'email' => 'jignesh@gogotripsus.com',
            'password' => Hash::make('Savitara@123p'),
            'email_verified_at' => now(),
        ]);
    }
}