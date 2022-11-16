<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);

        Permission::create(['name' => 'projects.manage']);
        Permission::create(['name' => 'projects.manage_self']);

        Permission::create(['name' => 'tasks.manage']);
        Permission::create(['name' => 'tasks.manage_self']);

        Permission::create(['name' => 'log-viewer']);

        $adminRole = Role::findByName(config('auth.roles.admin'));
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.change_role');
        $adminRole->givePermissionTo('projects.manage');
        $adminRole->givePermissionTo('tasks.manage');
        $adminRole->givePermissionTo('log-viewer');

        $userRole = Role::findByName(config('auth.roles.user'));
        $userRole->givePermissionTo('projects.manage_self');
        $userRole->givePermissionTo('tasks.manage_self');
    }
}
