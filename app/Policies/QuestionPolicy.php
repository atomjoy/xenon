<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
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
	public function view(Admin $admin, Question $question): bool
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
	public function update(Admin $admin, Question $question): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Question $question): bool
	{
		if ($admin->hasRole(['admin', 'super_admin', 'worker'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Question $question): bool
	{
		return $this->delete($admin, $question);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Question $question): bool
	{
		return $this->delete($admin, $question);
	}
}
