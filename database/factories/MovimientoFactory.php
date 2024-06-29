<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\Movimiento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movimiento>
 */
class MovimientoFactory extends Factory
{
    protected $model = Movimiento::class;

    public function definition()
    {
        return [
            'producto_id' => Producto::factory(),
            'tipo' => $this->faker->randomElement(['entrada', 'salida']),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'fecha' => $this->faker->date,
            'costo' => $this->faker->randomFloat(2, 1, 100),
            'precio' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
