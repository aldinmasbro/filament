<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $this->faker->addProvider(FakerPicsumImagesProvider::class);
        return [
            'image' => $this->faker->imageUrl(width: 800, height: 600),
            'name' => $this->faker->name(),
            'position' => $this->faker->word(),
        ];
    }
}
