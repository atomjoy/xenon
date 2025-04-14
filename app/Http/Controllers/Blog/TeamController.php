<?php

namespace App\Http\Controllers\Blog;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;

class TeamController extends Controller
{
	/**
	 * Get items.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new EmployeeCollection(Employee::latest('id')->paginate($perpage));
	}

	/**
	 * Get item.
	 */
	public function show(Employee $employee)
	{
		return $employee;
	}
}
