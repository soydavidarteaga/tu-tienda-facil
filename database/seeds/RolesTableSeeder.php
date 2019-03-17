<?php

use Illuminate\Database\Seeder;
use ProjectEcommerce\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => "admin"
        ]);

        Role::create([
            "name" => "client"
        ]);
    }
}
