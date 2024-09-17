<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\Product>
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
        $productableType = $this->faker->randomElement(['App\\Models\\Category', 'App\\Models\\SubCategory']);

        $productableModel = $productableType === 'App\\Models\\Category'
            ? Category::factory()->create()
            : SubCategory::factory()->create();

        return [
            'name' => $this->faker->word(),
            'manufacturer' => $this->faker->company(), 
            'description' => $this->faker->text(), 
            'price' => $this->faker->randomFloat(2, 10, 100), 
            'discount' => $this->faker->randomFloat(2, 0, 50), 
            'discount_valid_until' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'stock_status' => $this->faker->boolean(), 
            'productable_id' => $productableModel->id, 
            'productable_type' => $productableType, 
        ];
    }
}
