<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Employee::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new EmployeeCollection(Employee::latest('id')->paginate($perpage));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreEmployeeRequest $request)
	{
		Gate::authorize('create', Employee::class);

		$valid = $request->validated();

		$employee = Employee::create($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->resize(1024, 1024)
				->toWebp();

			$path = 'employees/employee-' . $employee->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$employee->update($valid);
		}

		return response()->json([
			'message' => 'Created',
			'data' => $employee,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Employee $employee)
	{
		Gate::authorize('view', $employee);

		return $employee;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Employee $employee)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateEmployeeRequest $request, Employee $employee)
	{
		Gate::authorize('update', $employee);

		$valid = $request->validated();

		$employee->update($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->resize(1024, 1024)
				->toWebp();

			$path = 'employees/employee-' . $employee->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$employee->update($valid);
		}

		return response()->json([
			'message' => 'Updated',
			'data' => $employee,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Employee $employee)
	{
		Gate::authorize('delete', $employee);

		try {
			if (Storage::exists($employee->image)) {
				Storage::delete($employee->image);
			}
		} catch (\Throwable $e) {
			report($e);
		}

		$employee->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove employee image
	 *
	 * @param Employee $employee
	 * @return void
	 */
	function remove(Employee $employee)
	{
		Gate::authorize('update', $employee);

		try {
			if (Storage::exists($employee->image)) {
				Storage::delete($employee->image);
				$employee->image = null;
				$employee->save();
			}

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}
}
