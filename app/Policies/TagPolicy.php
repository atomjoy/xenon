<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class TagPolicy
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
    public function view(Admin $admin, Tag $tag): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        if ($admin->hasRole(['admin', 'super_admin', 'writer'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Tag $tag): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $tag->article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Tag $tag): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $tag->article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can restore the model.
     */
    public function restore(Admin $admin, Tag $tag): bool
    {
        return $this->delete($admin, $tag);
    }

    /**
     * Determine whether the admin can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Tag $tag): bool
    {
        return $this->delete($admin, $tag);
    }
}
