<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetas = [
            [
                'nombre' => 'Oferta',
                'color' => '#FF0000',
            ],
            [
                'nombre' => 'Nuevo',
                'color' => '#00FF00',
            ],
            [
                'nombre' => 'Popular',
                'color' => '#0000FF',
            ],
            [
                'nombre' => 'Recomendado',
                'color' => '#FFA500',
            ],
            [
                'nombre' => 'Limitado',
                'color' => '#800080',
            ],
        ];

        foreach ($etiquetas as $etiqueta) {
            Etiqueta::create([
                'nombre' => $etiqueta['nombre'],
                'slug' => Str::slug($etiqueta['nombre']),
                'color' => $etiqueta['color'],
            ]);
        }
    }
}
