<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->word(),
            'descriptio' => $this->faker->word(),
            'icon' => $this->faker->imageUrl(),
            'sort' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
