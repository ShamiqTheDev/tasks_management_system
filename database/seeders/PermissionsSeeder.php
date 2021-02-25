<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permissions = [
    		'Create User',
    		'Edit User',
    		'Delete User',
    		'View User',

    		'Create Role',
    		'Edit Role',
    		'Delete Role',
    		'View Role',

    		'Create Permission',
    		'Edit Permission',
    		'Delete Permission',
            'View Permission',

            'View Role Permissions',
    		'Update Role Permissions',

    		'Create Task',
    		'Edit Task',
    		'Delete Task',
    		'View Task',
            'Update Task Status',
    		'Assign Task to Users',
    	];

    	$data = [];
    	foreach ($permissions as $key => $permission_name) {
    		Permission::create([ 'name' => $permission_name ]);
    	}
        
    }
}
