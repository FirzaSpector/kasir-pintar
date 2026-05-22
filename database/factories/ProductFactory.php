<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(2, true),
            'sku' => 'SKU-' . strtoupper(Str::random(8)),
            'barcode' => '899' . fake()->numerify('##########'),
            'price' => fake()->randomFloat(0, 1000, 100000),
            'stock' => fake()->numberBetween(10, 100),
            'image' => 'default.png',
        ];
    }
}
