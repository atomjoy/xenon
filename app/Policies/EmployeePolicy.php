<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
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
	public function view(Admin $admin, Employee $employee): bool
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
	public function update(Admin $admin, Employee $employee): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Employee $employee): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Employee $employee): bool
	{
		return $this->delete($admin, $employee);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Employee $employee): bool
	{
		return $this->delete($admin, $employee);
	}
}
