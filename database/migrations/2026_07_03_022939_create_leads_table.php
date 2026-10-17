<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->uuid('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            
            $table->uuid('corretor_id');
            $table->foreign('corretor_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('lead_name');
            $table->string('lead_phone');
            $table->string('lead_email')->nullable();
            $table->boolean('has_property_to_sell')->default(false);
            $table->text('sell_property_details')->nullable();
            $table->string('source')->default('site');
            $table->enum('status', ['new', 'contacted', 'converted'])->default('new');
            $table->timestamp('notification_sent_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};