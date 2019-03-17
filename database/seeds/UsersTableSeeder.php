<?php

use Illuminate\Database\Seeder;
use ProjectEcommerce\Role;
use ProjectEcommerce\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findOrFail(1);
        $role->user()->create([
            "name" => "Administrador",
            "email" => "admin@admin.com",
            "password" => bcrypt('password'),
        ]);
    }
}
