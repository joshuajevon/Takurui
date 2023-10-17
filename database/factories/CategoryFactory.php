<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_name = $this->faker->randomElement(['Standard','Limited Edition']);
        $slug = Str::slug($category_name,'-');
        return [
            'category_name' => $category_name,
            'slug' => $slug
        ];
    }
}
