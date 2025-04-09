<?php

namespace App\Http\Controllers\Blog;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreContactRequest $request)
	{
		$valid = $request->validated();
		$valid['ip'] = $request->ip();

		try {
			$contact = Contact::create($valid);

			$file = $request->file('file');

			if ($file) {
				$extension = $file->extension();

				$path = 'id-' . $contact->id . '.' . $extension;

				Storage::disk('local')->putFileAs('contact', $file, $path);

				$contact->file = 'contact/' . $path;

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
