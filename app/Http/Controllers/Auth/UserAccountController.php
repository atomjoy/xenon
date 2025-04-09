<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserAccountRequest;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
	function update(UserAccountRequest $request)
	{
		try {
			Auth::user()->update($request->validated());

			return response()->json([
				'message' => __("account.update.success"),
				'user' => Auth::user(),
			], 200);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__("account.update.error"), 422);
		}
	}
}
