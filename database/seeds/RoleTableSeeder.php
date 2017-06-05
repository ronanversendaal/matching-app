<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_client = new Role();
        $role_client->name = 'client';
        $role_client->description = 'Client';
        $role_client->save();

        $role_volunteer = new Role();
        $role_volunteer->name = 'volunteer';
        $role_volunteer->description = 'Volunteer';
        $role_volunteer->save();

        $role_accountable = new Role();
        $role_accountable->name = 'executive';
        $role_accountable->description = 'Executive';
        $role_accountable->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Admin';
        $role_admin->save();
    }
}
