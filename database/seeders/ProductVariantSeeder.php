<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Variantes de Camiseta Premium Poliéster
        $camisetaPrem = Product::where('name', 'Camiseta Premium Poliéster')->first();

        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Blanco', 'Negro', 'Azul', 'Rojo', 'Verde'];

        foreach ($sizes as $size) {
            foreach ($colors as $color) {
                ProductVariant::create([
                    'product_id' => $camisetaPrem->id,
                    'name' => "Camiseta $size $color",
                    'sku' => "CAMISETA-POLY-$size-" . strtoupper(substr($color, 0, 3)),
                    'size' => $size,
                    'color' => $color,
                    'material' => '100% Poliéster',
                    'sublimation_type' => 'Sublimación',
                    'cost_price' => 8.50,
                    'sale_price' => 18.99,
                    'stock' => 50
                ]);
            }
        }

        // Variantes de Camiseta Algodón DTF
        $camisetaDTF = Product::where('name', 'Camiseta Algodón DTF')->first();

        foreach ($sizes as $size) {
            foreach ($colors as $color) {
                ProductVariant::create([
                    'product_id' => $camisetaDTF->id,
                    'name' => "Camiseta DTF $size $color",
                    'sku' => "CAMISETA-DTF-$size-" . strtoupper(substr($color, 0, 3)),
                    'size' => $size,
                    'color' => $color,
                    'material' => '100% Algodón',
                    'sublimation_type' => 'DTF',
                    'cost_price' => 9.00,
                    'sale_price' => 19.99,
                    'stock' => 40
                ]);
            }
        }

        // Variantes de Tazas
        $tazaStd = Product::where('name', 'Taza Cerámica Estándar')->first();
        $tazaPrem = Product::where('name', 'Taza Cerámica Premium')->first();

        $colorsTaza = ['Blanco', 'Negro', 'Rojo', 'Azul'];

        foreach ($colorsTaza as $color) {
            ProductVariant::create([
                'product_id' => $tazaStd->id,
                'name' => "Taza 11oz $color",
                'sku' => "TAZA-11OZ-" . strtoupper(substr($color, 0, 3)),
                'color' => $color,
                'material' => 'Cerámica',
                'sublimation_type' => 'Sublimación',
                'cost_price' => 2.50,
                'sale_price' => 8.99,
                'stock' => 100
            ]);

            ProductVariant::create([
                'product_id' => $tazaPrem->id,
                'name' => "Taza 15oz Premium $color",
                'sku' => "TAZA-15OZ-" . strtoupper(substr($color, 0, 3)),
                'color' => $color,
                'material' => 'Cerámica Premium',
                'sublimation_type' => 'Sublimación',
                'cost_price' => 3.50,
                'sale_price' => 12.99,
                'stock' => 75
            ]);
        }

        // Variantes de Mochilas
        $mochilaEsc = Product::where('name', 'Mochila Escolar Poliéster')->first();
        $mochilaDeport = Product::where('name', 'Mochila Deportiva')->first();

        $coloresMochila = ['Negro', 'Azul', 'Rojo', 'Verde', 'Gris'];

        foreach ($coloresMochila as $color) {
            ProductVariant::create([
                'product_id' => $mochilaEsc->id,
                'name' => "Mochila Escolar $color",
                'sku' => "MOCHILA-ESC-" . strtoupper(substr($color, 0, 3)),
                'color' => $color,
                'material' => 'Poliéster',
                'sublimation_type' => 'Sublimación',
                'cost_price' => 12.00,
                'sale_price' => 34.99,
                'stock' => 30
            ]);

            ProductVariant::create([
                'product_id' => $mochilaDeport->id,
                'name' => "Mochila Deportiva $color",
                'sku' => "MOCHILA-DEP-" . strtoupper(substr($color, 0, 3)),
                'color' => $color,
                'material' => 'Poliéster Resistente',
                'sublimation_type' => 'Sublimación',
                'cost_price' => 15.00,
                'sale_price' => 44.99,
                'stock' => 25
            ]);
        }
    }
}