<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Backend\Supplier::create([
            'name' => 'Supplier User',
            'email' => 'supplier@mail.com',
            'password' => Hash::make(123456)]);
    }
}
