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
        $roles = [
            ['name' => 'fighter'],
            ['name' => 'sponsor'],
        ];

        if (! DB::table('roles')->count()) {
            DB::table('roles')->insert($roles);
        }
    }
}
