<?php

namespace Database\Seeders\Auth;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Spatie\PermissionsEnum;
use App\Enums\Spatie\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (RolesEnum::cases() as $item) {
            Role::create(['name' => $item->value, 'guard_name' => 'web']);
        }

        foreach (PermissionsEnum::cases() as $item) {
            Permission::create(['name' => $item->value, 'guard_name' => 'web']);
        }
    }
}
