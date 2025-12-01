<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // نظف الموجود (اختياري عند التطوير)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // صلاحيات
        $perms = [
            'view projects', 'create projects', 'edit projects', 'delete projects',
            'manage users', 'assign roles',
        ];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // أدوار
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user  = Role::firstOrCreate(['name' => 'user']);
        $investor = Role::firstOrCreate(['name' => 'investor']);

        // أعطِ admin كل الصلاحيات
        $admin->syncPermissions(Permission::all());

        // مثال: user يمكنه عرض وإنشاء مشاريع
        $user->syncPermissions(['view projects','create projects']);
    }
}