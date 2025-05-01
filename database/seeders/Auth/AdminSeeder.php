<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use App\Enums\Spatie\RolesEnum;
use App\Enums\Spatie\AdminPermissionsEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'Password123#'
        ]);

        $this->roles($user);

        $this->permissions($user);
    }

    function roles($user)
    {
        $role = app(Role::class)->findOrCreate(RolesEnum::ADMIN->value, 'web');

        $user->assignRole($role);
    }

    function permissions($user)
    {
        $writer = AdminPermissionsEnum::cases();

        foreach ($writer as $item) {
            $permission = app(Permission::class)->findOrCreate($item->value, 'web');
            $user->givePermissionTo($permission);
        }
    }
}
