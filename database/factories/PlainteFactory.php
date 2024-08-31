<?php

namespace Database\Factories;

use App\Models\Partie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Plainte;

class PlainteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plainte::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'motif' => $this->faker->sentence(),
            'magistrat_id' => User::factory(),
            'plaignant_id' => Partie::factory(),
            'accusee_id' => Partie::factory(),
        ];
    }
}
