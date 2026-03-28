<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@multicreath.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        // Vendedor
        $vendedor = User::create([
            'name' => 'Juan Vendedor',
            'email' => 'vendedor@multicreath.com',
            'password' => Hash::make('password123'),
        ]);
        $vendedor->roles()->attach(Role::where('name', 'vendedor')->first());

        // Cliente
        $cliente = User::create([
            'name' => 'María Cliente',
            'email' => 'cliente@multicreath.com',
            'password' => Hash::make('password123'),
        ]);
        $cliente->roles()->attach(Role::where('name', 'cliente')->first());
    }
}