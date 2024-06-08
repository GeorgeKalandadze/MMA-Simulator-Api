<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainingTypes = [
            ['name' => 'strength'],
            ['name' => 'agility'],
            ['name' => 'stamina'],
        ];

        if (! DB::table('training_types')->count()) {
            DB::table('training_types')->insert($trainingTypes);
        }
    }
}
