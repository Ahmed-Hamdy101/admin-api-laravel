<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissions
        $permissions = Permission::all();
        $admin = Role::whereName('Admin')->first();
        DB::table('role_permission')->insert([
            'role_id' => $admin->id,
            'permission_id' => $permissions->id,
        ]);
        $editor= Role::whereName('Editor')->first();
        foreach ($permissions as $permission) {
            if (!in_array($permission->name, ['edit_roles'])) {
                DB::table('role_permission')->insert([
                    'role_id' => $editor->id,
                    'permission_id' => $permission->whereIn('id', [5, 6, 7, 8])->pluck('id')->toArray(),
                ]);
            }
        }
        $viewer= Role::whereName('Viewer')->first();
        $viewerRoles = ['view_roles', 'view_users', 'view_products', 'view_orders'];
        foreach ($permissions as $permission) {
            if (!in_array($permission->name, $viewerRoles)) {
                DB::table('role_permission')->insert([
                    'role_id' => $viewer->id,
                    'permission_id' => $permission->whereIn('id', [5, 6, 7, 8])->pluck('id')->toArray(),
                ]);
            }
        }
    }
}
