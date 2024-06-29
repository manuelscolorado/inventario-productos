<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use App\Models\Movimiento;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Producto::factory(10)->create()->each(function ($producto) {
            Movimiento::factory(10)->create(['producto_id' => $producto->id]);
        });
    }
}
