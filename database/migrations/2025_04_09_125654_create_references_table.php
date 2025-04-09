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
		Schema::create('references', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('company');
			$table->string('message');
			$table->string('image')->nullable();
			$table->string('website')->nullable();
			$table->decimal('vote', 2, 1)->nullable()->default(5.0);
			$table->unsignedBigInteger('project_id')->nullable();
			$table->json('meta_seo')->nullable();
			$table->json('schema_seo')->nullable();
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('references');
	}
};
