<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use App\Enums\Spatie\RolesEnum;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Super User',
            'email' => 'superadmin@example.com',
            'password' => 'Password123#'
        ]);

        $this->roles($user);
    }

    function roles($user)
    {
        $role = app(Role::class)->findOrCreate(RolesEnum::SUPERADMIN->value, 'web');

        $user->assignRole($role);
    }
}
