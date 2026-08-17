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

        // products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('base_price', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('views_count')->default(0)
            $table->timestamps();
        });


        // product's specifications
        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('key'); 
            $table->string('value');
            $table->timestamps();

            $table->index(['product_id', 'key']);
        });


        // product's variants
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->decimal('price', 12, 2); // Dynamic Price per Option combo
            $table->integer('stock')->default(0);
            $table->timestamps();
        });


        // attributes 
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Size, Color, Storage
            $table->timestamps();
        });


        // attribute's value
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->cascadeOnDelete();
            $table->string('value'); // XL, Red, 256GB
            $table->timestamps();
        });


        // pivot table for variant & value
        Schema::create('attribute_value_product_variant', function (Blueprint $table) {
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained()->cascadeOnDelete();
            $table->primary(['product_variant_id', 'attribute_value_id'], 'variant_attribute_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_product_variant');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('product_specifications');
        Schema::dropIfExists('products');
    }
};
