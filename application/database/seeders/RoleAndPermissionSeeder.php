<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'super-admin']);

        /** @var Role $superAdminRole */
        $superAdminRole = Role::create(['name' => 'Super Admin']);

        $superAdminRole->givePermissionTo([
            'super-admin'
        ]);

        /** @var User $user */
        $user = User::first();
        $user->assignRole('Super Admin');
    }
}
