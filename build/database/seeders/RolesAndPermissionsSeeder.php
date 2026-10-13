<?php
  
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $defaultPermissions = [
            'users.index',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
            'users.destroy',
            'roles.index',
            'roles.create',
            'roles.store',
            'roles.edit',
            'roles.update',
            'roles.destroy',
            'permissions.index',
            'permissions.create',
            'permissions.store',
            'permissions.edit',
            'permissions.update',
            'permissions.destroy',
        ];

        foreach ($defaultPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        User::first()?->assignRole(['name' => $superAdmin]);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin = $admin->givePermissionTo(Permission::all());
    }
}
