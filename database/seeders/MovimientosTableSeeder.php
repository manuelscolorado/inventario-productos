<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movimientos')->insert([
            [
                'producto_id' => 1, // Replace with the actual product ID
                'tipo' => 'entrada',
                'cantidad' => 10,
                'fecha' => '2024-06-28',
                'costo' => 10.50, // Costo del producto
                'precio' => 15.00, // Precio de venta del producto
            ],
            [
                'producto_id' => 2, // Replace with the actual product ID
                'tipo' => 'salida',
                'cantidad' => 5,
                'fecha' => '2024-06-28',
                'costo' => 12.00, // Costo del producto
                'precio' => 18.00, // Precio de venta del producto
            ],
            // ... Más movimientos
        ]);
    }
}