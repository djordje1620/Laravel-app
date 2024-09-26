<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Iphone 12',
                'brand_id' => 1,
                'sctype_id' => 1,
                'color' => 'Midnight',
                'image' => 'iphone12.webp',
                'internal_memory' => '128GB',
                'ram' => '8GB',
            ],
            [
                'name' => 'Iphone 13',
                'brand_id' => 1,
                'sctype_id' => 1,
                'color' => 'Midnight',
                'image' => 'iphone13-black128gb.webp',
                'internal_memory' => '128GB',
                'ram' => '12GB',
            ],
            [
                'name' => 'Iphone 13',
                'brand_id' => 1,
                'sctype_id' => 1,
                'color' => 'White',
                'image' => 'iphone13-pink128gb.webp',
                'internal_memory' => '128GB',
                'ram' => '8GB',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
