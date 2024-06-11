<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = config('auth.defaults.guard');

        $permissions = [
            'create_fighter', 'improve_fighter_skill', 'create_fight_match', 'cancel_fight_match'
        ];

        $roles = [
            'fighter' => [
                'create_fighter',
                'improve_fighter_skill',
            ],
            'sponsor' => [],
            'organizer' => [
                'create_fight_match',
                'cancel_fight_match'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($roles as $roleName => $permissionNames) {
            $roleId = DB::table('roles')->insertGetId(['name' => $roleName, 'guard_name' => $guardName]);

            foreach ($permissionNames as $permissionName) {
                $permissionId = Permission::where('name', $permissionName)->first()->id;
                DB::table('role_has_permissions')->insert(['role_id' => $roleId, 'permission_id' => $permissionId]);
            }
        }
    }
}
