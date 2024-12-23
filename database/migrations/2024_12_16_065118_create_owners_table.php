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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('phone')->nullable();
            $table->string('store_name')->unique();
            $table->integer('default_lang_id')->default(0);
            $table->integer('currency_id')->default(0);
            $table->integer('special_id')->default(0);
            $table->boolean('active')->default(0);
            $table->string('password')->nullable();
            $table->string('domain')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
