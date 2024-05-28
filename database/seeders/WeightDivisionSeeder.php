<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $weightDivisions = [
            ['name' => 'Flyweight', 'min_weight' => 49, 'max_weight' => 52],
            ['name' => 'Bantamweight', 'min_weight' => 53, 'max_weight' => 56],
            ['name' => 'Featherweight', 'min_weight' => 57, 'max_weight' => 60],
            ['name' => 'Lightweight', 'min_weight' => 61, 'max_weight' => 65],
            ['name' => 'Welterweight', 'min_weight' => 66, 'max_weight' => 70],
            ['name' => 'Middleweight', 'min_weight' => 71, 'max_weight' => 77],
            ['name' => 'Light Heavyweight', 'min_weight' => 78, 'max_weight' => 84],
            ['name' => 'Heavyweight', 'min_weight' => 85, 'max_weight' => 120],
        ];

        if (! DB::table('weight_divisions')->count()) {
            DB::table('weight_divisions')->insert($weightDivisions);
        }
    }
}
