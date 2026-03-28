<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'company_name' => 'TextilPro Guatemala',
            'contact_person' => 'Juan García',
            'phone' => '7777-7777',
            'email' => 'ventas@textilpro.com',
            'address' => 'Zona 3, Guatemala',
            'product_category' => 'Camisetas'
        ]);

        Supplier::create([
            'company_name' => 'CeramicaPlus',
            'contact_person' => 'María López',
            'phone' => '8888-8888',
            'email' => 'info@ceramicaplus.com',
            'address' => 'San Roque, Guatemala',
            'product_category' => 'Tazas'
        ]);

        Supplier::create([
            'company_name' => 'Mochilas El Éxito',
            'contact_person' => 'Carlos Ruiz',
            'phone' => '9999-9999',
            'email' => 'ventas@mochilasexito.com',
            'address' => 'Mixco, Guatemala',
            'product_category' => 'Mochilas'
        ]);

        Supplier::create([
            'company_name' => 'Tintas y Tecnología',
            'contact_person' => 'Roberto Pérez',
            'phone' => '5555-5555',
            'email' => 'info@tintastec.com',
            'address' => 'Zona 12, Guatemala',
            'product_category' => 'Consumibles'
        ]);
    }
}