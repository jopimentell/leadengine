<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Passo 1: Expandir o ENUM para incluir valores antigos E novos
        DB::statement("ALTER TABLE users MODIFY COLUMN plan_type ENUM('free','pro','black','essencial','aceleracao','performance') NOT NULL DEFAULT 'essencial'");

        // Passo 2: Migrar dados dos valores antigos para os novos
        DB::statement("UPDATE users SET plan_type = 'essencial' WHERE plan_type = 'free'");
        DB::statement("UPDATE users SET plan_type = 'aceleracao' WHERE plan_type = 'pro'");
        DB::statement("UPDATE users SET plan_type = 'performance' WHERE plan_type = 'black'");

        // Passo 3: Restringir o ENUM apenas aos novos valores
        DB::statement("ALTER TABLE users MODIFY COLUMN plan_type ENUM('essencial','aceleracao','performance') NOT NULL DEFAULT 'essencial'");
    }

    public function down(): void
    {
        // Reverter: expandir, migrar de volta, restringir
        DB::statement("ALTER TABLE users MODIFY COLUMN plan_type ENUM('essencial','aceleracao','performance','free','pro','black') NOT NULL DEFAULT 'free'");

        DB::statement("UPDATE users SET plan_type = 'free' WHERE plan_type = 'essencial'");
        DB::statement("UPDATE users SET plan_type = 'pro' WHERE plan_type = 'aceleracao'");
        DB::statement("UPDATE users SET plan_type = 'black' WHERE plan_type = 'performance'");

        DB::statement("ALTER TABLE users MODIFY COLUMN plan_type ENUM('free','pro','black') NOT NULL DEFAULT 'free'");
    }
};