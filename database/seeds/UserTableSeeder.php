<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\UserDetails;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $role_client = Role::where('name', 'client')->first();
        $role_volunteer  = Role::where('name', 'volunteer')->first();
        $role_executive  = Role::where('name', 'executive')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $details = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10)];
        $details_2 = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10)];
        $details_3 = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10)];
        $details_4 = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10)];

        $client = new User();
        $client->name = 'Client Tester';
        $client->email = 'client@example.com';
        $client->password = bcrypt('client');
        $client->save();
        $client->roles()->attach($role_client);
        $client->details()->create($details);

        $volunteer = new User();
        $volunteer->name = 'Volunteer Tester';
        $volunteer->email = 'volunteer@example.com';
        $volunteer->password = bcrypt('volunteer');
        $volunteer->save();
        $volunteer->roles()->attach($role_volunteer);
        $volunteer->details()->create($details_2);

        $executive = new User();
        $executive->name = 'Executive Tester';
        $executive->email = 'executive@example.com';
        $executive->password = bcrypt('executive');
        $executive->save();
        $executive->roles()->attach($role_executive);
        $executive->details()->create($details_3);

        $admin = new User();
        $admin->name = 'Admin Tester';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);
        $admin->details()->create($details_4);
    }
}
