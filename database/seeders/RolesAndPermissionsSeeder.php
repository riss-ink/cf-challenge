<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit polls']);
        Permission::create(['name' => 'delete polls']);
        Permission::create(['name' => 'publish polls']);
        Permission::create(['name' => 'create polls']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo(['edit polls','delete polls','publish polls','create polls']);
        $role = Role::create(['name' => 'user']);

    }
}
