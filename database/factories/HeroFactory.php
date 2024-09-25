<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hero;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class HeroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hero::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $this->faker->addProvider(FakerPicsumImagesProvider::class);
        return [
            'image' => $this->faker->imageUrl(width: 800, height: 600),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'link1' => $this->faker->url(),
            'link2' => $this->faker->url(),
            'is_active' => $this->faker->word(),
        ];
    }
}
