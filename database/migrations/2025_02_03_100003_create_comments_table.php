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
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->string('content', 500);
			$table->string('link', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->string('ip_address', 255)->nullable();
			$table->boolean('is_approved')->nullable()->default(true);
			$table->timestamps();
			$table->morphs('commentable');
			$table->unsignedBigInteger('article_id');
			$table->unsignedBigInteger('reply_id')->nullable();
			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('reply_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
