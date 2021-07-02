<?php

namespace Database\Seeders;
use Spatie\Permission\Models\{ Permission, Role };
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Dashboard',
            'Security',
            'Permissions - View',
            'Permissions - Create',
            'Permissions - Edit',
            'Roles - View',
            'Roles - Create',
            'Roles - Edit',
            'Categories - View',
            'Categories - Create',
            'Categories - Edit',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        $roleAdmin = Role::create(['name' => 'Administrator','guard_name' => 'sanctum']);
        $roleAdmin->syncPermissions(Permission::all());
        
        $roleUser = Role::create(['name' => 'Users','guard_name' => 'sanctum']);
        $roleUser->givePermissionTo(Permission::find(1));
    }
}
