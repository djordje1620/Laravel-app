<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Honor'];

        foreach($brands as $brand){
            $brandObj = new Brand();
            $brandObj->brand = $brand;
            $brandObj->save();
        }
    }
}
