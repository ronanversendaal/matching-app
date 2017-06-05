<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Administrator',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'client']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Client',
                ])->save();
        }
        $role = Role::firstOrNew(['name' => 'volunteer']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Volunteer',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'executive']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Executive',
                ])->save();
        }
    }
}
