<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = Faker::create();
        $randomNumber = $faker->numberBetween(1, 10000);
        $profit = $randomNumber * 10/100 + $randomNumber;
        return [
            'name' => fake()->name(),
            'category_id' => Category::factory()->create()->id, 
            'cost_price' => $randomNumber,
            'selling_price' => $profit,
        ];
    }
}
