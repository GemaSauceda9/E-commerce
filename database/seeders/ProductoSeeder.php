<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();

        // Crear 20 productos de ejemplo
        for ($i = 1; $i <= 20; $i++) {
            $nombre = 'Producto ' . $i;
            $producto = Producto::create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
                'descripcion' => 'Descripción corta del producto ' . $i,
                'descripcion_larga' => 'Descripción detallada del producto ' . $i . '. Aquí pueden ir todas las características y especificaciones.',
                'precio' => rand(10, 1000) + (rand(0, 99) / 100),
                'stock' => rand(0, 100),
                'sku' => 'PROD-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'imagen' => 'productos/producto_' . $i . '.webp', // Nombre de imagen ficticio
                'destacado' => rand(0, 1),
                'activo' => true,
                'categoria_id' => $categorias->random()->id,
            ]);

            // Asignar entre 1 y 3 etiquetas aleatorias a cada producto
            $producto->etiquetas()->attach(
                $etiquetas->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
