<?php

namespace App\Enums\Spatie;

enum RolesEnum: string
{
	case SUPERADMIN = 'super_admin';
	case ADMIN = 'admin';
	case WORKER = 'worker';
	case WRITER = 'writer';

	public function label(): string
	{
		return match ($this) {
			static::SUPERADMIN => 'Super Admins',
			static::ADMIN => 'Admins',
			static::WORKER => 'Workers',
			static::WRITER => 'Writers',
			default => throw new \Exception('Unknown enum value requested for the label.'),
		};
	}
}
