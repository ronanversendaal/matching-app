<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use App\UserDetails;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        if (User::count() == 0) {

            $role = Role::where('name', 'superuser')->firstOrFail();

            User::create([
                'name'           => 'Superuser',
                'email'          => 'superuser@example.com', // Change this to something secure in production.
                'password'       => bcrypt('admin'),
                'role_id'        => $role->id,
                'approved'       => 1
            ]);

            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@example.com',
                'password'       => bcrypt('admin'),
                'role_id'        => $role->id,
                'approved'       => 1
            ]);

            $role_client = Role::where('name', 'client')->first();
            $role_volunteer  = Role::where('name', 'volunteer')->first();
            $role_executive  = Role::where('name', 'executive')->first();

            $client = User::create([
                'name'           => $faker->name,
                'email'          => 'client@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details = ['bio' => $faker->realText(600, 1), 'description' => $faker->realText(254, 1), 'profile' => 'https://placem.at/people?w=500&h=500&txt=0&random='.str_random(4), 'user_id' => $client->id];

            UserDetails::create($details);

            $client = User::create([
                'name'           => $faker->name,
                'email'          => 'client2@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details_2 = ['bio' => $faker->realText(600, 2), 'description' => $faker->realText(254, 2), 'profile' =>   'https://placem.at/people?w=500&h=500&txt=0&random='.str_random(4), 'user_id' => $client->id];

            UserDetails::create($details_2);

            $client = User::create([
                'name'           => $faker->name,
                'email'          => 'client3@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details_3 = ['bio' => $faker->realText(600, 3), 'description' => $faker->realText(254, 3), 'profile' => 'https://placem.at/people?w=500&h=500&txt=0&random='.str_random(4), 'user_id' => $client->id];

            UserDetails::create($details_3);

            $volunteer = User::create([
                'name'           => $faker->name,
                'email'          => 'volunteer@example.com',
                'password'       => bcrypt('volunteer'),
                'role_id'        => $role_volunteer->id,
                'approved'       => 1
            ]);

            $executive = User::create([
                'name'           => $faker->name,
                'email'          => 'executive@example.com',
                'password'       => bcrypt('executive'),
                'role_id'        => $role_executive->id,
                'approved'       => 1
            ]);

        }

    }
}
