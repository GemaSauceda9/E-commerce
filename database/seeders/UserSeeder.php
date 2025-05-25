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

         // Crear usuario 2 administrador
         User::factory()->create([
            'name' => 'Reyner',
            'email' => 'reyner@email.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'admin',
        ]);

        // Crear usuario cliente
        User::factory()->create([
            'name' => 'Cliente 1',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'cliente',
        ]);
         
        // Crear usuario cliente 2
        User::factory()->create([
            'name' => 'Cliente 2',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'cliente',
        ]);

        // Crear usuario cliente 3
        User::factory()->create([
            'name' => 'Cliente 3',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'cliente',
        ]);

         // Crear usuario cliente 4
         User::factory()->create([
            'name' => 'Cliente 4',
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
