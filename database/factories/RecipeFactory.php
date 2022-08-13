<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'category_uuid' => '',
            'gallery_directory' => $this->faker->name(),
            'preparation_time' => '1',
            'difficulty' => 1,
            'number_of_people_served' => 2,
            'ingredients' => $this->faker->name(),
            'preparation_mode' => $this->faker->name(),
            'is_active' => true,
        ];
    }
}
