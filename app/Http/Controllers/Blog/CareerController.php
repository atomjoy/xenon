<?php

namespace App\Http\Controllers\Blog;

use App\Models\Work;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkCollection;
use App\Http\Requests\StoreCareerRequest;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
	/**
	 * Get items.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new WorkCollection(Work::latest('id')->paginate($perpage));
	}

	/**
	 * Get item.
	 */
	public function show(Work $work)
	{
		return $work;
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCareerRequest $request)
	{
		$valid = $request->validated();
		$valid['ip'] = $request->ip();

		try {
			$contact = Contact::create($valid);

			$file = $request->file('file');

			if ($file) {
				$extension = $file->extension();

				$path = 'id-' . $contact->id . '.' . $extension;

				Storage::disk('local')->putFileAs('career', $file, $path);

				$contact->file = 'career/' . $path;

				$contact->save();
			}
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			], 422);
		}

		return response()->json([
			'message' => 'Message has been created.',
			'data' => $contact,
		]);
	}
}
