<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Piece;

class PieceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Piece::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
