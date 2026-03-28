<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Categorías de PRODUCTOS
        $camisetas = Category::create([
            'name' => 'Camisetas',
            'type' => 'product',
            'description' => 'Camisetas personalizadas con sublimación y DTF'
        ]);

        Category::create([
            'name' => 'Camisetas Sublimación',
            'type' => 'product',
            'parent_id' => $camisetas->id,
            'description' => 'Camisetas 100% poliéster para sublimación'
        ]);

        Category::create([
            'name' => 'Camisetas DTF',
            'type' => 'product',
            'parent_id' => $camisetas->id,
            'description' => 'Camisetas de algodón con impresión DTF'
        ]);

        $tazas = Category::create([
            'name' => 'Tazas',
            'type' => 'product',
            'description' => 'Tazas cerámicas personalizadas'
        ]);

        Category::create([
            'name' => 'Tazas Cerámica',
            'type' => 'product',
            'parent_id' => $tazas->id,
        ]);

        $mochilas = Category::create([
            'name' => 'Mochilas',
            'type' => 'product',
            'description' => 'Mochilas escolares y deportivas'
        ]);

        Category::create([
            'name' => 'Mochilas Sublimadas',
            'type' => 'product',
            'parent_id' => $mochilas->id,
        ]);

        // Categorías de SERVICIOS
        $diseño = Category::create([
            'name' => 'Diseño Web',
            'type' => 'service',
            'description' => 'Servicios de diseño y desarrollo web'
        ]);

        Category::create([
            'name' => 'Sitios Web Responsivos',
            'type' => 'service',
            'parent_id' => $diseño->id,
        ]);

        Category::create([
            'name' => 'E-commerce',
            'type' => 'service',
            'parent_id' => $diseño->id,
        ]);

        $branding = Category::create([
            'name' => 'Branding',
            'type' => 'service',
            'description' => 'Servicios de identidad visual y branding'
        ]);

        Category::create([
            'name' => 'Diseño de Logo',
            'type' => 'service',
            'parent_id' => $branding->id,
        ]);

        Category::create([
            'name' => 'Identidad Corporativa',
            'type' => 'service',
            'parent_id' => $branding->id,
        ]);

        $marketing = Category::create([
            'name' => 'Marketing Digital',
            'type' => 'service',
            'description' => 'Servicios de marketing y publicidad digital'
        ]);

        Category::create([
            'name' => 'Redes Sociales',
            'type' => 'service',
            'parent_id' => $marketing->id,
        ]);

        Category::create([
            'name' => 'Publicidad Digital',
            'type' => 'service',
            'parent_id' => $marketing->id,
        ]);
    }
}