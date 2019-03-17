<?php

use Illuminate\Database\Seeder;
use ProjectEcommerce\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            "company_name" => "Company C.A",
            "email" => "company@company.com",
            "phone" => "+584249994988",
            "country" => "Venezuela",
            "state" => "Carabobo",
            "city" => "San Diego",
            "address" => "Mi direccion"
        ]);
    }
}
