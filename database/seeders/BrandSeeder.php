<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $brands = [
            'Toyota',
            'Honda',
            'Daihatsu',
            'Suzuki',
            'Mitsubishi',
            'Nissan',
            'Wuling',
            'Hyundai',
            'Mazda',
            'BMW',
            'Mercedes-Benz',
            'Isuzu',
            'Chevrolet',
            'Volkswagen',
            'Kia',
            'Chery',
            'Audi',
            'Porsche',
            'Lexus',
            'Subaru',
            'Fiat',
            'Jeep',
            'Land Rover',
            'Volvo',
            'Mini',
            'Infiniti'
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand
            ]);
        }
    }
}
