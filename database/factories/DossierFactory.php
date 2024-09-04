<?php

namespace Database\Factories;

use App\Enums\FolderState;
use App\Models\Plainte;
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
            'nom' => $this->faker->title(),
            'date_ouverture' => $this->faker->date(),
            'suite_reservee' => $this->faker->randomElement(FolderState::class),
            'date_fixation' => $this->faker->date(),
            'date_classement' => $this->faker->date(),
            'plainte_id' => Plainte::factory(),
        ];
    }
}
