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
		Schema::create('tags', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('article_id');
			$table->string('slug', 255);
			$table->timestamps();
			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('cascade')->onDelete('cascade');
			$table->unique(['slug', 'article_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('tags');
	}
};
