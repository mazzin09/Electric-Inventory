<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Support\Str;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::doesntHave('inventory')->get();
        foreach ($items as $item) {
            Inventory::factory()->create([
                'item_id' => $item->id,
            ]);
        }
    }
}
