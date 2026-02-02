<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    public function definition(): array
    {
        $local = Equip::factory();
        $visitant = Equip::factory();

        return [
            'local_id' => $local,
            'visitant_id' => $visitant,
            'data_partit' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'gols_local' => $this->faker->numberBetween(0, 5),
            'gols_visitant' => $this->faker->numberBetween(0, 5),
        ];
    }
}