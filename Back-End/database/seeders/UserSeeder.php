<?php

namespace Database\Seeders;

use App\Enums\RolePossition;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::firstOrCreate([
            'username' => 'manager',
        ], [
            'name'     => 'Manager User',
            'password' => bcrypt('password'),
        ]);

        $dev = User::firstOrCreate([
            'username' => 'developer',
        ], [
            'name'     => 'Developer User',
            'password' => bcrypt('password'),
        ]);

        $design = User::firstOrCreate([
            'username' => 'designer',
        ], [
            'name'     => 'Designer User',
            'password' => bcrypt('password'),
        ]);

        // Attach role via pivot
        $managerRole = Role::where('name', RolePossition::MANAGER->value)->first();
        $manager->roles()->sync([$managerRole->id]);

        $devRole = Role::where('name', RolePossition::WEB_DEVELOPER->value)->first();
        $dev->roles()->sync([$devRole->id]);

        $designRole = Role::where('name', RolePossition::WEB_DESIGNER->value)->first();
        $design->roles()->sync([$designRole->id]);
    }
}
