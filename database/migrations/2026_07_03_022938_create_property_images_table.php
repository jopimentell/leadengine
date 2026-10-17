<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->uuid('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            
            $table->string('url');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_enhanced')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};