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
		// Products
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description')->nullable()->default('');
			$table->boolean('on_stock')->nullable()->default(1);
			$table->boolean('visible')->nullable()->default(1);
			$table->unsignedBigInteger('sorting')->nullable()->default(0);
			$table->timestamps();
			$table->unique('name');
		});

		// Product attributes
		Schema::create('attributes', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id');
			$table->string('name');
			$table->timestamps();
			$table->unique(['product_id', 'name']);
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});

		// Attributes properties
		Schema::create('props', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('attribute_id');
			$table->string('name')->nullable();
			$table->timestamps();
			$table->unique(['attribute_id', 'name']);
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
		});

		// Product variants
		Schema::create('skus', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('price')->default(0);
			$table->unsignedBigInteger('price_sale')->default(0);
			$table->string('slug')->default('sku-' . uniqid()); // 1310349-desktop-g4m3r-elite-r7-9800x3d-64gb-2tb-rtx5090-w11px
			$table->string('name')->nullable();
			$table->unsignedBigInteger('quantity')->nullable()->default(1);
			$table->boolean('on_stock')->nullable()->default(1);
			$table->boolean('on_sale')->nullable()->default(0);
			$table->boolean('visible')->nullable()->default(1);
			$table->timestamps();
			$table->unique('name');
			$table->unique('slug');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});

		// Pivot table product variants and attributes
		Schema::create('attribute_sku', function (Blueprint $table) {
			$table->id('id');
			$table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade');
			$table->foreignId('sku_id')->constrained('skus')->onDelete('cascade');
			$table->string('value');
			$table->timestamps();
			$table->unique(['attribute_id', 'sku_id']);

			// Or with props without value
			// $table->unsignedBigInteger('prop_id');
			// $table->foreign('prop_id')->references('id')->on('props')->onUpdate('cascade')->onDelete('cascade');
		});

		// Sku images
		Schema::create('images', function (Blueprint $table) {
			$table->id();
			$table->string('url');
			$table->morphs('imageable'); // imageable_id and imageable_type
			$table->unsignedBigInteger('likes')->nullable()->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('images');
		Schema::dropIfExists('attribute_sku');
		Schema::dropIfExists('skus');
		Schema::dropIfExists('props');
		Schema::dropIfExists('attributes');
		Schema::dropIfExists('products');
	}
};
