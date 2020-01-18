<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Backend\Company::create([
            'name' => 'Company User',
            'email' => 'company@mail.com',
            'password' => Hash::make(123456)]);
    }
}
