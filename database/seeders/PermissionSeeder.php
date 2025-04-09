<?php

namespace Database\Seeders;

use App\Enums\AdminRoles;
use App\Enums\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin guard
        $this->adminRoles();

        // Web guard
        $this->userRoles();
    }

    /**
     * Admin all roles
     *
     * @return void
     */
    function adminRoles()
    {
        // Admin all roles
        foreach (AdminRoles::allRoles() as $role) {
            Role::create(['name' => $role, 'guard_name' => 'admin']);
        }
    }

    /**
     * User all roles
     *
     * @return void
     */
    function userRoles()
    {
        // User roles
        foreach (UserRoles::allRoles() as $role) {
            Role::create(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
