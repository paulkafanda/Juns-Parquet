<?php

namespace Database\Factories;

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
            'user_id' => UserFactory::class,
            'plaignat' => PartieFactory::class,
            'accusee' => PartieFactory::class,
        ];
    }
}
