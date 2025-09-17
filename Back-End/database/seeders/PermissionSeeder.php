<?php

namespace Database\Seeders;

use App\Enums\RolePossition;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions from routes
        foreach (\Route::getRoutes() as $route) {
            $name = $route->getName();
            if ($name) {
                Permission::firstOrCreate(['name' => $name]);
            }
        }

        // Create roles from enum
        foreach (RolePossition::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value]);
        }

        // Assign permissions
        $manager  = Role::where('name', RolePossition::MANAGER->value)->first();
        $dev    = Role::where('name', RolePossition::WEB_DEVELOPER->value)->first();
        $design = Role::where('name', RolePossition::WEB_DESIGNER->value)->first();

        $manager->permissions()->sync(Permission::pluck('id')->toArray());

        $managerPermissions = Permission::whereIn('name', [
            'employees.store',
            'employees.index',
            'employees.show',
            'employees.update',
            'employees.destroy',
            'options.position',
        ])->pluck('id')->toArray();

        $NonManagerPermissions = Permission::whereIn('name', [
            'employees.store',
            'employees.index',
            'employees.show',
            'employees.update',
            'employees.destroy',
        ])->pluck('id')->toArray();

        $manager->permissions()->sync($managerPermissions);
        $dev->permissions()->sync($NonManagerPermissions);
        $design->permissions()->sync($NonManagerPermissions);
    }
}
