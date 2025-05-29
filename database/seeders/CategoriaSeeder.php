<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'TI',
            'Manutenção',
            'Suporte RH',
        ];

        foreach ($categorias as $nome) {
            Categoria::updateOrCreate(
                ['nome' => $nome],
                ['nome' => $nome]
            );
        }
    }
}
