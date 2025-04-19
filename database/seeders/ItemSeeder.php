<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $items = [
            [
                'name' => 'Toyota Fortuner 2023 Black Edition',
                'description' => 'The Toyota Fortuner 2023 Black Edition is a special variant of the popular SUV, featuring a sleek black exterior and premium interior finishes.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda BRV 2023 Sport Edition',
                'description' => 'The Honda BRV 2023 Sport Edition is a sporty version of the compact SUV, offering enhanced performance and stylish design elements.',
                'brand_id' => 2,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Daihatsu Terios 2023 Adventure Edition',
                'description' => 'The Daihatsu Terios 2023 Adventure Edition is designed for off-road enthusiasts, featuring rugged styling and advanced off-road capabilities.',
                'brand_id' => 3,
                'user_id' => 1,
                'condition' => 'used',
            ],
        ];

        foreach ($items as $item) {
            Item::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'brand_id' => $item['brand_id'],
                'user_id' => $item['user_id'],
                'condition' => $item['condition'],
            ]);
        }
    }
}
