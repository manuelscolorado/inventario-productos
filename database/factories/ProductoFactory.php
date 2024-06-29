<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'stockid' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'cantidad' => $this->faker->numberBetween(1, 100),
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'costo' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
