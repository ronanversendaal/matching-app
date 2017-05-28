<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_client = Role::where('name', 'client')->first();
        $role_volunteer  = Role::where('name', 'volunteer')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $client = new User();
        $client->name = 'Client Tester';
        $client->email = 'client@example.com';
        $client->password = bcrypt('secret');
        $client->save();
        $client->roles()->attach($role_client);

        $volunteer = new User();
        $volunteer->name = 'Volunteer Tester';
        $volunteer->email = 'volunteer@example.com';
        $volunteer->password = bcrypt('secret');
        $volunteer->save();
        $volunteer->roles()->attach($role_volunteer);

        $admin = new User();
        $admin->name = 'Admin Tester';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
