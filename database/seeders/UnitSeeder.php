<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create(['name' => 'Unidad', 'symbol' => 'u']);
        Unit::create(['name' => 'Metro', 'symbol' => 'm']);
        Unit::create(['name' => 'Paquete', 'symbol' => 'pkg']);
        Unit::create(['name' => 'Proyecto', 'symbol' => 'p']);
        Unit::create(['name' => 'Hora', 'symbol' => 'h']);
    }
}