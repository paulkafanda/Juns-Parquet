<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Audience;
use App\Models\Dossier;
use App\Models\User;

class AudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Audience::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime(),
            'lieu' => $this->faker->word(),
            'statut' => $this->faker->word(),
            'user_id' => User::factory(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
