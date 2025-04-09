<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('category_id')->nullable();
			$table->string('name')->unique();
			$table->string('slug')->unique();
			$table->text('about')->nullable();
			$table->string('image')->nullable();
			$table->timestamps();
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('categories');
	}
};
