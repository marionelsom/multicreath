<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $consumidor = CustomerType::where('name', 'Consumidor Final')->first();
        $mayorista = CustomerType::where('name', 'Mayorista')->first();
        $corporativo = CustomerType::where('name', 'Corporativo')->first();

        // Consumidores Finales
        Customer::create([
            'full_name' => 'Juan Pérez García',
            'email' => 'juan@gmail.com',
            'phone' => '7777-7777',
            'address' => 'Zona 3, Guatemala',
            'customer_type_id' => $consumidor->id
        ]);

        Customer::create([
            'full_name' => 'María López Rodríguez',
            'email' => 'maria@gmail.com',
            'phone' => '8888-8888',
            'address' => 'Zona 10, Guatemala',
            'customer_type_id' => $consumidor->id
        ]);

        Customer::create([
            'full_name' => 'Carlos Ruiz Martínez',
            'email' => 'carlos@gmail.com',
            'phone' => '9999-9999',
            'address' => 'Mixco, Guatemala',
            'customer_type_id' => $consumidor->id
        ]);

        // Mayoristas
        Customer::create([
            'full_name' => 'Importadora El Éxito S.A.',
            'company_name' => 'Importadora El Éxito',
            'contact_person' => 'Roberto Díaz',
            'email' => 'ventas@importexito.com',
            'phone' => '5555-5555',
            'address' => 'Zona 12, Guatemala',
            'customer_type_id' => $mayorista->id,
            'nit' => '123456789',
            'credit_limit' => 5000.00
        ]);

        Customer::create([
            'full_name' => 'Distribuidora Central',
            'company_name' => 'Distribuidora Central S.A.',
            'contact_person' => 'Andrés López',
            'email' => 'info@distribuidora.com',
            'phone' => '4444-4444',
            'address' => 'Zona 2, Guatemala',
            'customer_type_id' => $mayorista->id,
            'nit' => '987654321',
            'credit_limit' => 8000.00
        ]);

        // Corporativos
        Customer::create([
            'full_name' => 'TechSolutions Guatemala',
            'company_name' => 'TechSolutions S.A.',
            'contact_person' => 'Ing. Fernando García',
            'email' => 'contacto@techsolutions.com',
            'phone' => '2222-2222',
            'address' => 'Edificio Corporate, Zona 10',
            'customer_type_id' => $corporativo->id,
            'nit' => '456789123',
            'credit_limit' => 15000.00
        ]);

        Customer::create([
            'full_name' => 'Marketing Pro Guatemala',
            'company_name' => 'Marketing Pro S.A.',
            'contact_person' => 'Lic. Sofía Mejía',
            'email' => 'admin@marketingpro.com',
            'phone' => '3333-3333',
            'address' => 'Zona 4, Guatemala',
            'customer_type_id' => $corporativo->id,
            'nit' => '789123456',
            'credit_limit' => 10000.00
        ]);
    }
}