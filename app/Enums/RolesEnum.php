<?php

namespace App\Enums;

enum RolesEnum: string
{
	case ADMIN = 'admin';
	case SUPERADMIN = 'super_admin';
	case WORKER = 'worker';
	case WRITER = 'writer';

	public function label(): string
	{
		return match ($this) {
			static::ADMIN => 'Admins',
			static::SUPERADMIN => 'SuperAdmins',
			static::WORKER => 'Workers',
			static::WRITER => 'Writers',
		};
	}
}
