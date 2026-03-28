<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $unitU = Unit::where('symbol', 'u')->first();

        // Productos de Camisetas
        $catCamisetasSub = Category::where('name', 'Camisetas Sublimación')->first();
        $catCamisetasDTF = Category::where('name', 'Camisetas DTF')->first();

        Product::create([
            'name' => 'Camiseta Premium Poliéster',
            'category_id' => $catCamisetasSub->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Camiseta 100% poliéster, perfecta para sublimación'
        ]);

        Product::create([
            'name' => 'Camiseta Algodón DTF',
            'category_id' => $catCamisetasDTF->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Camiseta 100% algodón, ideal para impresión DTF'
        ]);

        // Productos de Tazas
        $catTazas = Category::where('name', 'Tazas Cerámica')->first();

        Product::create([
            'name' => 'Taza Cerámica Estándar',
            'category_id' => $catTazas->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Taza cerámica 11oz, color blanco para personalización'
        ]);

        Product::create([
            'name' => 'Taza Cerámica Premium',
            'category_id' => $catTazas->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Taza cerámica 15oz, calidad premium'
        ]);

        // Productos de Mochilas
        $catMochilas = Category::where('name', 'Mochilas Sublimadas')->first();

        Product::create([
            'name' => 'Mochila Escolar Poliéster',
            'category_id' => $catMochilas->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Mochila escolar de poliéster apta para sublimación'
        ]);

        Product::create([
            'name' => 'Mochila Deportiva',
            'category_id' => $catMochilas->id,
            'unit_id' => $unitU->id,
            'type' => 'blanco',
            'description' => 'Mochila deportiva resistente al agua'
        ]);
    }
}