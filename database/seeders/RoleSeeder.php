<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);


        $viewAllTasksPermission = Permission::create(['name' => 'view all tasks']);
        $createTaskPermission = Permission::create(['name' => 'create task']);
        $viewOwnTaskPermission = Permission::create(['name' => 'view own task']);
        $updateOwnTaskPermission = Permission::create(['name' => 'update own task']);
        $deleteOwnTaskPermission = Permission::create(['name' => 'delete own task']);
        $allUserPermission = Permission::create(['name' => 'view all user']);
        $adduserPermission= Permission::create(['name' => 'add user']);
        $deleteUserPermission= Permission::create(['name' => 'delete user']);
        $updateUserPermission= Permission::create(['name' => 'update user']);


        $adminRole->syncPermissions([
            $viewAllTasksPermission,
            $allUserPermission,
            $adduserPermission,
            $deleteUserPermission,
            $updateUserPermission
        ]);

        $userRole->syncPermissions([
            $createTaskPermission,
            $viewOwnTaskPermission,
            $updateOwnTaskPermission,
            $deleteOwnTaskPermission,
        ]);
    }
}
