<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class CommentPolicy
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
    public function view(Admin $admin, Comment $comment): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return false;
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Comment $comment): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $comment->article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Comment $comment): bool
    {
        if ($admin->hasRole(['admin', 'super_admin'])) {
            return true;
        }

        if ($admin->hasRole(['writer'])) {
            return $admin->id === $comment->article->admin_id;
        }

        return false;
    }

    /**
     * Determine whether the admin can restore the model.
     */
    public function restore(Admin $admin, Comment $comment): bool
    {
        return $this->delete($admin, $comment);
    }

    /**
     * Determine whether the admin can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Comment $comment): bool
    {
        return $this->delete($admin, $comment);
    }
}
