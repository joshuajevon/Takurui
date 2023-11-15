<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_name = $this->faker->randomElement([
            "Naruto",
            "One Piece",
            "Dragon Ball",
            "Attack on Titan",
            "My Hero Academia",
            "Sword Art Online",
            "Fullmetal Alchemist",
            "Death Note",
            "Demon Slayer",
            "Tokyo Ghoul",
            "Neon Genesis Evangelion",
            "Hunter x Hunter",
            "Cowboy Bebop",
            "Fairy Tail",
            "Steins;Gate",
            "Bleach",
            "Naruto Shippuden",
            "One Punch Man",
            "JoJo's Bizarre Adventure",
            "Re:Zero - Starting Life in Another World"
          ]);
        $slug = Str::slug($product_name,'-');
        return [
            'name' => $product_name,
            'slug' => $slug,
            'description' => $this->faker->text(200),
            'price' => $this->faker->numberBetween(1000000,5000000),
            'stock' => $this->faker->numberBetween(10,50),
            'image' => 'product-1.jpg',
            'category_id' => 1
        ];
    }
}
