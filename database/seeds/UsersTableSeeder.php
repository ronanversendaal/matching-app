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
                'name'           => 'Client Tester',
                'email'          => 'client@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10), 'user_id' => $client->id];

            UserDetails::create($details);

            $client = User::create([
                'name'           => 'Client Tester 2',
                'email'          => 'client2@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details_2 = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10), 'user_id' => $client->id];

            UserDetails::create($details_2);

            $client = User::create([
                'name'           => 'Client Tester 3',
                'email'          => 'client3@example.com',
                'password'       => bcrypt('client'),
                'role_id'        => $role_client->id,
                'approved'       => 1
            ]);

            $details_3 = ['bio' => $faker->realText(254), 'profile' => 'https://api.adorable.io/avatars/500/'.str_random(10), 'user_id' => $client->id];

            UserDetails::create($details_3);

            $volunteer = User::create([
                'name'           => 'Volunteer Tester',
                'email'          => 'volunteer@example.com',
                'password'       => bcrypt('volunteer'),
                'role_id'        => $role_volunteer->id,
                'approved'       => 1
            ]);

            $executive = User::create([
                'name'           => 'Executive Tester',
                'email'          => 'executive@example.com',
                'password'       => bcrypt('executive'),
                'role_id'        => $role_executive->id,
                'approved'       => 1
            ]);

        }

    }
}
