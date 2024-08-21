<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Partie;

class PartieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partie::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role' => $this->faker->word(),
            'nom' => $this->faker->word(),
            'post_nom' => $this->faker->word(),
            'prenom' => $this->faker->word(),
            'adresse' => $this->faker->word(),
            'sexe' => $this->faker->word(),
            'tel' => $this->faker->word(),
            'origine' => $this->faker->word(),
        ];
    }
}
