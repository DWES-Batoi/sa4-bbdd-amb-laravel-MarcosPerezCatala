<?php

namespace Database\Factories;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Jugadora>
 */
class JugadoraFactory extends Factory
{
    /**
     * El modelo correspondiente a esta factory.
     *
     * @var string
     */
    protected $model = Jugadora::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'      => $this->faker->name('female'),
            'dorsal'   => $this->faker->numberBetween(1, 99),
            'posicio'  => $this->faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
            'equip_id' => Equip::factory(),
        ];
    }
}
