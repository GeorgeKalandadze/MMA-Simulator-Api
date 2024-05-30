<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = config('auth.defaults.guard');

        $roles = [
            ['name' => 'fighter', 'guard_name' => $guardName],
            ['name' => 'sponsor', 'guard_name' => $guardName],
            ['name' => 'organizer', 'guard_name' => $guardName],
        ];

        if (! DB::table('roles')->count()) {
            DB::table('roles')->insert($roles);
        }
    }
}
