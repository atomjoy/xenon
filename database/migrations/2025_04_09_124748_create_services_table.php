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
		Schema::create('services', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('excerpt');
			$table->string('slug')->unique();
			$table->text('content_html')->nullable();
			$table->text('content_cleaned')->nullable();
			$table->string('tags')->nullable();
			$table->string('image')->nullable();
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
		Schema::dropIfExists('services');
	}
};
