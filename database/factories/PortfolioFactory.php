<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Support\Str;
use App\Models\PortfolioCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class PortfolioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Portfolio::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $this->faker->addProvider(FakerPicsumImagesProvider::class);
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(width: 800, height: 600),
            'link' => $this->faker->word(),
            'is_active' => $this->faker->word(),
            'portfolio_category_id' => PortfolioCategory::factory(),
        ];
    }
}
