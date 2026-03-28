<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    public function run(): void
    {
        CustomerType::create([
            'name' => 'Consumidor Final',
            'discount_percentage' => 0
        ]);

        CustomerType::create([
            'name' => 'Mayorista',
            'discount_percentage' => 15
        ]);

        CustomerType::create([
            'name' => 'Distribuidor',
            'discount_percentage' => 25
        ]);

        CustomerType::create([
            'name' => 'Corporativo',
            'discount_percentage' => 10
        ]);
    }
}