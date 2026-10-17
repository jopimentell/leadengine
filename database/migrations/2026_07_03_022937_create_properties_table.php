<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('price_rent', 15, 2)->nullable();
            
            $table->string('street')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->decimal('area_sqmt', 10, 2)->nullable();
            
            $table->enum('status', ['active', 'inactive', 'sold'])->default('active');
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('lead_count')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};