<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screens = ['OLED', 'AMOLED', 'IPS'];

        foreach($screens as $screen){
            $scObj = new Screen();
            $scObj->screen = $screen;
            $scObj->save();
        }
    }
}
