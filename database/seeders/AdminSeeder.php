<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Enums\AdminRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// Create admin account
		Admin::factory()->create([
			'name' => 'Admin',
			'email' => 'admin@example.com',
			'password' => 'Password123#'
		])->assignRole([
			...AdminRoles::adminRoles(),
		]);

		// Admin::factory()->create([
		//     'name' => 'Super Admin',
		//     'email' => 'super@example.com',
		//     'password' => 'Password123#'
		// ])->assignRole([
		//     ...AdminRoles::superAdminRoles(),
		// ]);

		// Admin::factory()->create([
		// 	'name' => 'Writer',
		// 	'email' => 'writer@example.com',
		// 	'password' => 'Password123#'
		// ])->assignRole([
		// 	...AdminRoles::writerRoles(),
		// ]);

		// Admin::factory()->create([
		//     'name' => 'Worker',
		//     'email' => 'worker@example.com',
		//     'password' => 'Password123#'
		// ])->assignRole([
		//     ...AdminRoles::workerRoles(),
		// ]);
	}
}
