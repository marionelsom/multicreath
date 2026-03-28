<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;
use App\Models\Category;
use App\Models\CustomerType;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ── Units ─────────────────────────────────────────────
        $units = [
            ['name' => 'Unidad',   'symbol' => 'u'],
            ['name' => 'Metro',    'symbol' => 'm'],
            ['name' => 'Paquete',  'symbol' => 'pkg'],
            ['name' => 'Proyecto', 'symbol' => 'p'],
            ['name' => 'Hora',     'symbol' => 'h'],
            ['name' => 'Kilogramo','symbol' => 'kg'],
        ];
        foreach ($units as $u) {
            Unit::firstOrCreate(['symbol' => $u['symbol']], $u);
        }

        // ── Product Categories ────────────────────────────────
        $productCats = [
            'Camisetas y Ropa',
            'Tazas y Bebidas',
            'Mochilas y Bolsos',
            'Accesorios',
            'Material de Oficina',
            'Decoración',
            'Artículos Deportivos',
        ];
        foreach ($productCats as $name) {
            Category::firstOrCreate(['name' => $name, 'type' => 'product']);
        }

        // ── Service Categories ────────────────────────────────
        $serviceCats = [
            'Diseño Web',
            'Branding e Identidad',
            'Marketing Digital',
            'Fotografía y Video',
            'Desarrollo de Software',
            'Consultoría IT',
        ];
        foreach ($serviceCats as $name) {
            Category::firstOrCreate(['name' => $name, 'type' => 'service']);
        }

        // ── Customer Types ────────────────────────────────────
        $types = [
            ['name' => 'Consumidor Final', 'discount_percentage' => 0],
            ['name' => 'Mayorista',        'discount_percentage' => 15],
            ['name' => 'Corporativo',      'discount_percentage' => 20],
            ['name' => 'Revendedor',       'discount_percentage' => 10],
        ];
        foreach ($types as $t) {
            CustomerType::firstOrCreate(['name' => $t['name']], $t);
        }

        // ── Admin User ────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@multicreath.com'],
            [
                'name'     => 'Admin MULTICREATH',
                'password' => Hash::make('admin123456'),
                'is_admin' => true,
            ]
        );

        $this->command->info('✓ Datos iniciales del panel admin creados.');
        $this->command->info('  Usuario: admin@multicreath.com');
        $this->command->info('  Contraseña: admin123456');
        $this->command->warn('  ¡Cambia la contraseña inmediatamente!');
    }
}
