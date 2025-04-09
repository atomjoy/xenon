<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Events\LoggedUser;
use App\Events\LoggedUserError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedController extends Controller
{
	function index(Request $request)
	{
		Auth::shouldUse('admin'); // Default guard

		try {
			if (Auth::check()) {
				LoggedUser::dispatch(Auth::user());

				return response()->json([
					'message' => __('logged.authenticated'),
					'guard' => 'admin',
					'user' => Auth::user()->fresh(),
				], 200);
			} else {
				LoggedUserError::dispatch();
				throw new \Exception("Admin not logged");
			}
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => __('logged.unauthenticated'),
				'guard' => 'web',
				'user' => null,
			], 422);
		}
	}
}
