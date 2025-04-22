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
                'brand_id' => 1, // Toyota
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Honda BRV 2023 Sport Edition',
                'description' => 'Sporty compact SUV with 1.5L engine, 7 seats, and modern connectivity features.',
                'brand_id' => 2, // Honda
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Daihatsu Xenia 2023',
                'description' => 'Practical family MPV with efficient fuel consumption and versatile seating.',
                'brand_id' => 3, // Daihatsu
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Suzuki XL7 2023',
                'description' => 'Modern 7-seater SUV with comfortable interior and fuel efficiency.',
                'brand_id' => 4, // Suzuki
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Mitsubishi Xpander 2023',
                'description' => 'Popular family MPV with dynamic shield design and spacious cabin.',
                'brand_id' => 5, // Mitsubishi
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Nissan X-Trail 2023',
                'description' => 'Advanced SUV with e-POWER technology and ProPILOT features.',
                'brand_id' => 6, // Nissan
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Wuling Air EV 2023',
                'description' => 'Compact electric vehicle with modern features and city-friendly design.',
                'brand_id' => 7, // Wuling
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Hyundai IONIQ 5 2023',
                'description' => 'Award-winning electric crossover with futuristic design.',
                'brand_id' => 8, // Hyundai
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Mazda CX-5 2023',
                'description' => 'Premium crossover SUV with elegant design and refined driving dynamics.',
                'brand_id' => 9, // Mazda
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'BMW X5 2023 M Sport',
                'description' => 'Luxury SUV with sporty handling and premium features.',
                'brand_id' => 10, // BMW
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Mercedes-Benz C200 2022',
                'description' => 'Executive sedan with elegant design and advanced technology.',
                'brand_id' => 11, // Mercedes-Benz
                'user_id' => 1,
                'condition' => 'used',
            ],
            [
                'name' => 'Isuzu MU-X 2023',
                'description' => 'Robust SUV with powerful diesel engine and reliable performance.',
                'brand_id' => 12, // Isuzu
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Chevrolet Corvette 2023',
                'description' => 'Iconic American sports car with mid-engine layout.',
                'brand_id' => 13, // Chevrolet
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Volkswagen Golf GTI 2023',
                'description' => 'Hot hatchback with legendary performance and modern tech.',
                'brand_id' => 14, // Volkswagen
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Kia EV6 2023',
                'description' => 'Electric crossover with striking design and long range.',
                'brand_id' => 15, // Kia
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Audi Q5 2023 Quattro',
                'description' => 'Premium SUV with all-wheel drive and sophisticated interior.',
                'brand_id' => 17, // Audi
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Porsche 911 GT3 2023',
                'description' => 'High-performance sports car with track-focused capabilities.',
                'brand_id' => 18, // Porsche
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Lexus RX 2023 Hybrid',
                'description' => 'Luxury hybrid SUV with innovative technology and comfort.',
                'brand_id' => 19, // Lexus
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Subaru WRX 2023',
                'description' => 'All-wheel drive sports sedan with turbocharged performance.',
                'brand_id' => 20, // Subaru
                'user_id' => 1,
                'condition' => 'new',
            ],
            [
                'name' => 'Land Rover Defender 2023',
                'description' => 'Iconic off-road SUV with modern luxury features.',
                'brand_id' => 23, // Land Rover
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
