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
		Schema::create('articles', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('image')->nullable();
			$table->string('excerpt')->nullable();
			$table->text('content_html')->nullable();
			$table->text('content_cleaned')->nullable();
			$table->json('meta_seo')->nullable();
			$table->json('schema_seo')->nullable();
			$table->unsignedBigInteger('views')->nullable()->default(0);
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('articles');
	}
};
