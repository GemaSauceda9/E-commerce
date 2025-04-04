<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Electrónica',
                'descripcion' => 'Productos electrónicos y tecnológicos',
            ],
            [
                'nombre' => 'Ropa',
                'descripcion' => 'Todo tipo de prendas de vestir',
            ],
            [
                'nombre' => 'Hogar',
                'descripcion' => 'Artículos para el hogar',
            ],
            [
                'nombre' => 'Deportes',
                'descripcion' => 'Productos deportivos y fitness',
            ],
            [
                'nombre' => 'Belleza',
                'descripcion' => 'Productos de belleza y cuidado personal',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'nombre' => $categoria['nombre'],
                'slug' => Str::slug($categoria['nombre']),
                'descripcion' => $categoria['descripcion'],
                'activo' => true,
            ]);
        }
    }
}
