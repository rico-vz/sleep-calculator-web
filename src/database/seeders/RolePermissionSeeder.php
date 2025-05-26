<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $viewAdminDashboard = Permission::firstOrCreate(['name' => 'view admin dashboard']);
        $viewBackups = Permission::firstOrCreate(['name' => 'view backups']);
        $downloadBackups = Permission::firstOrCreate(['name' => 'download backups']);
        $deleteBackups = Permission::firstOrCreate(['name' => 'delete backups']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole->givePermissionTo([
            $viewAdminDashboard,
            $viewBackups,
            $downloadBackups,
            $deleteBackups,
        ]);

        $user = User::find(1);
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
