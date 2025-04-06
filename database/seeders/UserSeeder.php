<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::factory()->create([
            'name' => 'Gema',
            'email' => 'gema@email.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'admin',
        ]);

        // Crear usuario cliente
        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'cliente',
        ]);

        // Crear varios usuarios cliente aleatorios
        User::factory(5)->create([
            'tipo_usuario' => 'cliente',
        ]);
    }
}
