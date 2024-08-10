<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::all()->pluck('id');
        \App\Models\Item::factory(20)->create([
           'category_id' => fn() => $categories->random(),
        ]);
    }
}
