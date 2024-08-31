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
            'nom' => $this->faker->firstName(),
            'post_nom' => $this->faker->lastName(),
            'prenom' => $this->faker->name(),
            'adresse' => $this->faker->streetAddress(),
            'sexe' => $this->faker->randomElement(['M','F', 'O']),
            'tel' => $this->faker->phoneNumber(),
            'origine' => $this->faker->address(),
        ];
    }
}
