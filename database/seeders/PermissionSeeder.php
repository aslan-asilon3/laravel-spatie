<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;

use App\Models\User;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        // create permissions
        Permission::create(['name' => 'product-list']);
        Permission::create(['name' => 'product-create']);
        Permission::create(['name' => 'product-edit']);
        Permission::create(['name' => 'product-delete']);

        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);

        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);

        Permission::create(['name' => 'view-dashboard']);
        Permission::create(['name' => 'view-features']);
        Permission::create(['name' => 'view-pricing']);
        

        //create roles and assign existing permissions
        $writerRole = Role::create(['name' => 'writer']);
        
        $writerRole->givePermissionTo('view-pricing');

        $adminRole = Role::create(['name' => 'admin']);

        // $adminRole->givePermissionTo('user-list');
        // $adminRole->givePermissionTo('user-create');
        // $adminRole->givePermissionTo('user-edit');
        // $adminRole->givePermissionTo('user-delete');

        $adminRole->givePermissionTo('product-list');
        $adminRole->givePermissionTo('product-create');
        $adminRole->givePermissionTo('product-edit');
        $adminRole->givePermissionTo('product-delete');

        $adminRole->givePermissionTo('role-list');
        // $adminRole->givePermissionTo('role-create');
        // $adminRole->givePermissionTo('role-edit');
        // $adminRole->givePermissionTo('role-delete');

        $adminRole->givePermissionTo('view-dashboard');
        $adminRole->givePermissionTo('view-features');

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'name' => 'aslanwriter',
            'email' => 'aslanwriter@gmail.com',
            'password' => bcrypt('aslanwriter')
        ]);
        $user->assignRole($writerRole);

        $user = User::factory()->create([
            'name' => 'aslanadmin',
            'email' => 'aslanadmin@gmail.com',
            'password' => bcrypt('aslanadmin')
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'aslansuperadmin',
            'email' => 'aslansuperadmin@gmail.com',
            'password' => bcrypt('aslansuperadmin')
        ]);
        $user->assignRole($superadminRole);

    }

}
