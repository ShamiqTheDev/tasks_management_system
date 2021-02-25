<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permissions_data = [
    		'Admin',
    		'Manager',
    		'Employee',
    	];

    	foreach ($permissions_data as $permission) {
	        Role::create([ 'name' => $permission ]);
    	}

        Role::findByName('Admin')->givePermissionTo(Permission::all());
    }
}
