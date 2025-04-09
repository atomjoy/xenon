<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...UserRoles::allRoles(),
        ]);
    }
}
