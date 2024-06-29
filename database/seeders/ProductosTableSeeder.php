<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Producto 1',
                'descripcion' => 'Descripción del producto 1',
                'precio' => 100.00,
                'stock' => 10,
            ],
            [
                'nombre' => 'Producto 2',
                'descripcion' => 'Descripción del producto 2',
                'precio' => 200.00,
                'stock' => 5,
            ],
            // ... Más productos
        ]);
    }
}