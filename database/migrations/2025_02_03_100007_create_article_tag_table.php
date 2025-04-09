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
		// Schema::create('article_tag', function (Blueprint $table) {
		// 	$table->id();
		// 	$table->timestamps();
		// 	$table->unsignedBigInteger('tag_id')->nullable();
		// 	$table->unsignedBigInteger('article_id')->nullable();
		// 	$table->foreign('article_id')->references('id')->on('articles')->onUpdate('cascade')->onDelete('cascade');
		// 	$table->foreign('tag_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
		// });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('article_tag');
	}
};
