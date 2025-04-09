<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Category $category): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Category $category): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Category $category): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the admin can restore the model.
     */
    public function restore(Admin $admin, Category $category): bool
    {
        return $this->delete($admin, $category);
    }

    /**
     * Determine whether the admin can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Category $category): bool
    {
        return $this->delete($admin, $category);
    }
}
