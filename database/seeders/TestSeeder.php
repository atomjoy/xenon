<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\AdminRoles;
use App\Enums\UserRoles;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Permissions
        $this->call([
            PermissionSeeder::class,
        ]);

        // User guard
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...UserRoles::allRoles(),
        ]);

        // User::factory(10)->create()->assignRole([...UserRoles::allRoles()]);

        // Admin guard
        Admin::factory()->create([
            'name' => 'Test Writer',
            'email' => 'writer@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...AdminRoles::writerRoles(),
        ]);

        Admin::factory()->create([
            'name' => 'Test Worker',
            'email' => 'worker@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...AdminRoles::workerRoles(),
        ]);

        Admin::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...AdminRoles::adminRoles(),
        ]);

        Admin::factory()->create([
            'name' => 'Test SuperAdmin',
            'email' => 'super@example.com',
            'password' => 'Password123#'
        ])->assignRole([
            ...AdminRoles::superAdminRoles(),
        ]);

        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
        ]);
    }
}
