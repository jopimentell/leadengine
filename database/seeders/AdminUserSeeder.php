<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Verifica se já existe um admin para evitar duplicação
        if (User::where('email', 'admin@larnex.com.br')->exists()) {
            $this->command->info('Usuário admin já existe. Atualizando...');
            $user = User::where('email', 'admin@larnex.com.br')->first();
            $user->is_admin = true;
            $user->save();
            return;
        }

        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin Teste',
            'slug' => 'admin-teste', // slug fixo para facilitar
            'email' => 'admin@larnex.com.br',
            'phone' => '5511999999999',
            'password' => bcrypt('password'),
            'plan_type' => 'pro',
            'is_admin' => true, // <-- ADICIONAR ESTA LINHA
            'trial_ends_at' => now()->addDays(30),
            'setup_fee_paid' => true,
        ]);
    }
}