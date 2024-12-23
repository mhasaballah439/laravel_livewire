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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('brand_id')->default(0);
            $table->integer('tax_id')->default(0);
            $table->string('slug')->unique();
            $table->text('tags')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('details')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('qualifies_for_returns')->default(0);
            $table->boolean('on_sale')->default(0);
            $table->boolean('track_inventory')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
