<?php

namespace Database\Seeders\Auth;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            WriterSeeder::class,
            AdminSeeder::class,
            SuperAdminSeeder::class,
        ]);
    }
}
