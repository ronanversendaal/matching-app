<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'client';
        $role_employee->description = 'Client';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'volunteer';
        $role_manager->description = 'Volunteer';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'Admin';
        $role_manager->save();
    }
}
