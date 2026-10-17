<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique()->nullable(); // SEM AFTER
            $table->string('phone')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');                     // SENHA
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);   // SEM AFTER
            $table->string('avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('creci')->nullable();
            $table->enum('plan_type', ['free', 'pro', 'black'])->default('free');
            $table->timestamp('trial_ends_at')->nullable();
            $table->boolean('has_custom_domain')->default(false);
            $table->boolean('setup_fee_paid')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};