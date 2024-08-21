<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Partie;

class DossierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dossier::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date_ouverture' => $this->faker->date(),
            'suite_reservee' => $this->faker->word(),
            'date_fixation' => $this->faker->date(),
            'data_classement' => $this->faker->date(),
            'partie_id' => Partie::factory(),
        ];
    }
}
