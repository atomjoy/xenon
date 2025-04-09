<?php

namespace App\Policies;

use App\Models\Work;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class WorkPolicy
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
	public function view(Admin $admin, Work $work): bool
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
	public function update(Admin $admin, Work $work): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Work $work): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Work $work): bool
	{
		return $this->delete($admin, $work);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Work $work): bool
	{
		return $this->delete($admin, $work);
	}
}
