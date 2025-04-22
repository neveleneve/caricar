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
                'description' => 'The Toyota Fortuner 2023 Black Edition features a sleek black exterior, premium leather interior, and advanced safety features.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda BRV 2023 Sport Edition',
                'description' => 'Sporty compact SUV with 1.5L engine, 7 seats, and modern connectivity features.',
                'brand_id' => 2,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Toyota Camry 2023 Hybrid',
                'description' => 'Luxury sedan with hybrid powertrain, offering exceptional fuel efficiency and comfort.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda Civic Type R 2023',
                'description' => 'High-performance hatchback with 2.0L turbo engine and race-inspired design.',
                'brand_id' => 2,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Toyota RAV4 2022 Adventure',
                'description' => 'Compact SUV with robust off-road capabilities and spacious interior.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Daihatsu Xenia 2023',
                'description' => 'Practical family MPV with efficient fuel consumption and versatile seating.',
                'brand_id' => 3,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'BMW X5 2023 M Sport',
                'description' => 'Luxury SUV with sporty handling and premium features.',
                'brand_id' => 4,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Mercedes-Benz C200 2022',
                'description' => 'Executive sedan with elegant design and advanced technology.',
                'brand_id' => 5,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Audi Q5 2023 Quattro',
                'description' => 'Premium SUV with all-wheel drive and sophisticated interior.',
                'brand_id' => 6,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Toyota Hilux 2023 4x4',
                'description' => 'Robust pickup truck with excellent off-road capabilities.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda HR-V 2022 RS',
                'description' => 'Compact crossover with sporty styling and versatile interior.',
                'brand_id' => 2,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Daihatsu Rocky 2023',
                'description' => 'Compact SUV with modern features and efficient engine.',
                'brand_id' => 3,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'BMW 330i 2023',
                'description' => 'Sports sedan with dynamic performance and luxury amenities.',
                'brand_id' => 4,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Mercedes-Benz GLC 300 2023',
                'description' => 'Premium SUV with cutting-edge technology and refined comfort.',
                'brand_id' => 5,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Audi A6 2022',
                'description' => 'Executive sedan with sophisticated design and advanced features.',
                'brand_id' => 6,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Toyota Vellfire 2023',
                'description' => 'Luxury MPV with premium features and spacious cabin.',
                'brand_id' => 1,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda Accord 2023 Hybrid',
                'description' => 'Executive sedan with hybrid powertrain and premium features.',
                'brand_id' => 2,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'BMW M3 2022 Competition',
                'description' => 'High-performance sedan with track-focused capabilities.',
                'brand_id' => 4,
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Mercedes-Benz S500 2023',
                'description' => 'Flagship luxury sedan with state-of-the-art technology.',
                'brand_id' => 5,
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Audi RS e-tron GT 2023',
                'description' => 'All-electric performance sedan with cutting-edge technology.',
                'brand_id' => 6,
                'user_id' => 1,
                'condition' => 'new',
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
