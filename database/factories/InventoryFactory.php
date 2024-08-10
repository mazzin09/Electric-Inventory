<?php

namespace Database\Factories;
use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sku' => $this->generateUniqueSku(),
            'item_id' => Item::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
    private function generateUniqueSku()
    {
        do {
            $sku = strtoupper(Str::random(8));
        } while (Inventory::where('sku', $sku)->exists());

        return $sku;
    }
}
