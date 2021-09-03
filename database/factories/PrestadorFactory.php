<?php

namespace Database\Factories;

use App\Models\Prestador;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prestador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'codigo' => $this->faker->randomNumber(9, true),
            'correo' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'carrera_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
