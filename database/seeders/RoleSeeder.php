<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Administrador del sistema'
        ]);

        Role::create([
            'name' => 'vendedor',
            'description' => 'Vendedor / Gerente de ventas'
        ]);

        Role::create([
            'name' => 'cliente',
            'description' => 'Cliente'
        ]);
    }
}