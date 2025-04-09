<?php

namespace App\Rules;

use Illuminate\Support\Str;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsValidJson implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!is_array($value)) {
			if (!Str::isJson($value)) {
				$fail('The :attribute must be the json string.');
			}
		}
	}
}
