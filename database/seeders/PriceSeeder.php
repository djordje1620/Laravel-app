<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            ['product_id' => 1, 'price' => 799.99, 'active' => true],
            ['product_id' => 2, 'price' => 899.99, 'active' => true],
            ['product_id' => 3, 'price' => 939.99, 'active' => true],
        ];

        foreach ($prices as $price) {
            Price::create($price);
        }
    }
}
