<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Backend\Product::create(['name' => 'Mango']);
        App\Models\Backend\Product::create(['name' => 'Thirt']);
        App\Models\Backend\Product::create(['name' => 'Car']);
        App\Models\Backend\Product::create(['name' => 'Motor Bike']);
        App\Models\Backend\Product::create(['name' => 'Cycle']);
        App\Models\Backend\Product::create(['name' => 'Tea']);
    }
}
