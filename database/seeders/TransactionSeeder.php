<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemCount = Item::count();
        if ($itemCount == 0) {
            $this->command->info('No items found. Please run the item seeder first.');
            return;
        }

        // Create 100 transactions
        Transaction::factory()->count(100)->create();

        // Ensure we have at least one purchase and one sale for each item
        Item::all()->each(function ($item) {
            Transaction::factory()->create([
                'item_id' => $item->id,
                'transaction_type' => 'purchase',
            ]);
            Transaction::factory()->create([
                'item_id' => $item->id,
                'transaction_type' => 'sale',
            ]);
        });
    }
}
