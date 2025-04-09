<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
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
	public function view(Admin $admin, Project $project): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can create models.
	 */
	public function create(Admin $admin): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can update the model.
	 */
	public function update(Admin $admin, Project $project): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Project $project): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Project $project): bool
	{
		return $this->delete($admin, $project);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Project $project): bool
	{
		return $this->delete($admin, $project);
	}
}
