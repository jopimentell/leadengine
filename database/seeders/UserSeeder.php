<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN – plano mais alto
        User::firstOrCreate(
            ['email' => 'admin@larnex.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Admin Larnex',
                'slug' => 'admin-larnex',
                'phone' => '5511999999999',
                'password' => bcrypt('password'),
                'plan_type' => 'performance', // <-- ERA 'black'
                'is_admin' => true,
                'trial_ends_at' => now()->addYears(10),
                'setup_fee_paid' => true,
                'city' => 'São Paulo',
                'creci' => '123456',
            ]
        );

        // CORRETORES – atualizar os plan_type
        $corretores = [
            [
                'name' => 'João Silva',
                'slug' => 'joao-silva',
                'email' => 'joao@exemplo.com',
                'phone' => '5511988888888',
                'city' => 'São Paulo',
                'creci' => 'SP12345',
                'plan_type' => 'aceleracao', // <-- ERA 'pro'
            ],
            [
                'name' => 'Maria Santos',
                'slug' => 'maria-santos',
                'email' => 'maria@exemplo.com',
                'phone' => '5511977777777',
                'city' => 'Rio de Janeiro',
                'creci' => 'RJ67890',
                'plan_type' => 'aceleracao',
            ],
            [
                'name' => 'Carlos Oliveira',
                'slug' => 'carlos-oliveira',
                'email' => 'carlos@exemplo.com',
                'phone' => '5511966666666',
                'city' => 'Belo Horizonte',
                'creci' => 'MG11223',
                'plan_type' => 'essencial', // <-- ERA 'free'
            ],
            [
                'name' => 'Ana Pereira',
                'slug' => 'ana-pereira',
                'email' => 'ana@exemplo.com',
                'phone' => '5511955555555',
                'city' => 'Curitiba',
                'creci' => 'PR44556',
                'plan_type' => 'aceleracao',
            ],
            [
                'name' => 'Roberto Lima',
                'slug' => 'roberto-lima',
                'email' => 'roberto@exemplo.com',
                'phone' => '5511944444444',
                'city' => 'Porto Alegre',
                'creci' => 'RS77889',
                'plan_type' => 'essencial',
            ],
            [
                'name' => 'Fernanda Costa',
                'slug' => 'fernanda-costa',
                'email' => 'fernanda@exemplo.com',
                'phone' => '5511933333333',
                'city' => 'Salvador',
                'creci' => 'BA99001',
                'plan_type' => 'performance', // <-- ERA 'black'
            ],
        ];

        foreach ($corretores as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'id' => (string) Str::uuid(),
                    'name' => $data['name'],
                    'slug' => $data['slug'],
                    'phone' => $data['phone'],
                    'password' => bcrypt('password'),
                    'plan_type' => $data['plan_type'],
                    'is_admin' => false,
                    'trial_ends_at' => now()->addDays(30),
                    'setup_fee_paid' => true,
                    'city' => $data['city'],
                    'creci' => $data['creci'],
                ]
            );
        }
    }
}