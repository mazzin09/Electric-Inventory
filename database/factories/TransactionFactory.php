<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $item = Item::inRandomOrder()->first();
        $transactionType = $this->faker->randomElement(['purchase', 'sale']);
        $quantity = $this->faker->randomFloat(2, 1, 100);
        $unitPrice = $this->faker->randomFloat(2, 10, 1000);
        $totalAmount = $quantity * $unitPrice;

        return [
            'item_id' => $item->id,
            'quantity' => $quantity,
            'transaction_type' => $transactionType,
            'total_amount' => $totalAmount,
        ];
    }
}
