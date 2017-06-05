<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        // @todo add super user role and add all permissions

        // Admin may do certain stuff
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        // Executive may enter admin, and browse/read matches
        $role = Role::where('name', 'executive')->firstOrFail();

        // Restrict certain
        $permissions = Permission::whereIn('key', [
            'browse_admin'
        ])->get();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        // Browse app for volunteers
        $role = Role::where('name', 'volunteer')->firstOrFail();

        $permissions = Permission::where(['key' => 'browse_app'])->get();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
