<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
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
    public function view(Admin $admin, Article $article): bool
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
    public function update(Admin $admin, Article $article): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Article $article): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can restore the model.
     */
    public function restore(Admin $admin, Article $article): bool
    {
        return $this->delete($admin, $article);
    }

    /**
     * Determine whether the admin can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Article $article): bool
    {
        return $this->delete($admin, $article);
    }
}
