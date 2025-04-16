# Laravel Products

Mysql product table structires.

## Product variants (many to many)

```sh
Products (id, name, desc, visible)
# 1, Shirt, Description, true
# 2, Laptop, Description, true

Skus (id, price, slug, product_id, stock_qty, on_stock = true)
# 1, 5.00, 'sku-100', 1, 55 // S-Blue
# 2, 6.00, 'sku-200', 1, 66 // S-Red
# 3, 7.00, 'sku-300', 1, 77 // M-Blue
# 4, 8.00, 'sku-400', 1, 88 // M-Red
# 10, 500, 'sku-501', 2, 3  // Intel-32GB
# 11, 600, 'sku-502', 2, 5  // Intel-64GB
# 12, 500, 'sku-601', 2, 8  // Amd-32GB
# 13, 600, 'sku-602', 2, 4  // Amd-64GB

Attributes (id, product_id, name)
# 1, 1, Size
# 2, 1, Color
# 3, 2, Procesor
# 4, 2, Ram
# 5, 2, Disk
# 6, 2, Graphics

Properties (id, attribute_id, name)
# 1, 1, S
# 2, 1, M
# 3, 2, Blue
# 4, 2, Red
# 5, 3, Intel
# 6, 3, Amd
# 7, 4, 32GB
# 8, 4, 64GB
# 9, 5, SSD
# 10, 5, HDD
# 11, 6, RTX4060
# 12, 6, RX7800

# Pivot table (or with 'property_id' not 'value')
attribute_sku (id, attribute_id, sku_id, value)
# 1,1,1,S
# 2,2,1,Blue
# 3,1,2,S
# 4,2,2,Red
# 5,1,3,M
# 6,2,3,Blue
# 7,1,4,M
# 8,2,4,Red
# 21,3,10,Intel
# 22,4,10,32GB
# 23,3,11,Intel
# 24,4,11,64GB
# 25,3,12,Amd
# 26,4,12,32GB
# 27,3,13,Amd
# 28,4,13,64GB
```

## Schema tables

```php
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
```
