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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('apply_type_id')->default(1);
            $table->integer('discount_type_id')->default(1);
            $table->integer('count_use')->default(1);
            $table->decimal('min_order_price',8,2)->default(0);
            $table->decimal('discount',8,2)->default(0);
            $table->text('desc')->nullable();
            $table->string('st_date')->nullable();
            $table->string('end_date')->nullable();
            $table->json('products')->nullable();
            $table->json('categories')->nullable();
            $table->json('users')->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
