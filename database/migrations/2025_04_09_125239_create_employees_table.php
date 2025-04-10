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
		Schema::create('employees', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('position');
			$table->string('slug')->nullable()->unique();
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->string('experience')->nullable();
			$table->string('image')->nullable();
			$table->string('excerpt')->nullable();
			$table->text('content_html')->nullable();
			$table->text('content_cleaned')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('instagram')->nullable();
			$table->string('youtube')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('pinterest')->nullable();
			$table->string('dribbble')->nullable();
			$table->string('behance')->nullable();
			$table->unsignedBigInteger('views')->nullable()->default(0);
			$table->json('meta_seo')->nullable();
			$table->json('schema_seo')->nullable();
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('employees');
	}
};
