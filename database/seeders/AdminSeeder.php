<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => "Faizan Ahmed",
            'last_name' => "Raza",
            'email' => "admin@example.com",
            'email_verified_at' => now(),
            'password' => 'admin123', // admin123
            'status' => User::STATUS['active'],
            'remember_token' => Str::random(10),
        ]);
    }
}
