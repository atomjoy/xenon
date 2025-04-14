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
		Schema::create('works', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->nullable()->unique();
			$table->string('experience')->nullable()->default('2 Years');
			$table->string('time')->nullable()->default('Full Time');
			$table->string('remote')->nullable()->default('On Site');
			$table->string('salary')->nullable()->default('To Be Agreed');
			$table->string('location')->nullable()->default('On Place');
			$table->text('content_html')->nullable();
			$table->text('content_cleaned')->nullable();
			$table->unsignedBigInteger('views')->nullable()->default(0);
			$table->json('meta_seo')->nullable();
			$table->json('schema_seo')->nullable();
			$table->timestamp('published_at')->nullable();
			$table->timestamp('expired_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('works');
	}
};
