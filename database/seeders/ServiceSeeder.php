<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $unitP = Unit::where('symbol', 'p')->first();
        $unitH = Unit::where('symbol', 'h')->first();

        // Servicios de Diseño Web
        $catWebResp = Category::where('name', 'Sitios Web Responsivos')->first();
        $catEcommerce = Category::where('name', 'E-commerce')->first();

        Service::create([
            'name' => 'Sitio Web Responsivo',
            'category_id' => $catWebResp->id,
            'unit_id' => $unitP->id,
            'description' => 'Desarrollo de sitio web responsivo con diseño moderno'
        ]);

        Service::create([
            'name' => 'Tienda E-commerce',
            'category_id' => $catEcommerce->id,
            'unit_id' => $unitP->id,
            'description' => 'Desarrollo de tienda online con carrito de compras'
        ]);

        // Servicios de Branding
        $catLogo = Category::where('name', 'Diseño de Logo')->first();
        $catIdentidad = Category::where('name', 'Identidad Corporativa')->first();

        Service::create([
            'name' => 'Diseño de Logo',
            'category_id' => $catLogo->id,
            'unit_id' => $unitP->id,
            'description' => 'Diseño profesional de logo personalizado'
        ]);

        Service::create([
            'name' => 'Identidad Corporativa Completa',
            'category_id' => $catIdentidad->id,
            'unit_id' => $unitP->id,
            'description' => 'Manual de marca, logo, tarjetas, papelería, etc.'
        ]);

        // Servicios de Marketing
        $catRedes = Category::where('name', 'Redes Sociales')->first();
        $catPubDigital = Category::where('name', 'Publicidad Digital')->first();

        Service::create([
            'name' => 'Gestión de Redes Sociales',
            'category_id' => $catRedes->id,
            'unit_id' => $unitH->id,
            'description' => 'Administración y contenido para redes sociales'
        ]);

        Service::create([
            'name' => 'Campaña de Publicidad Digital',
            'category_id' => $catPubDigital->id,
            'unit_id' => $unitP->id,
            'description' => 'Estrategia y ejecución de campañas publicitarias'
        ]);
    }
}