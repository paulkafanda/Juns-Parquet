<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Jugement;

class JugementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jugement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime(),
            'description' => $this->faker->text(),
            'statut' => $this->faker->word(),
            'decision' => $this->faker->word(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
