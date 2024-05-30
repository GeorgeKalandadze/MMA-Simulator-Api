<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MartialArtStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $martialArtStyles = [
            ['name' => 'Boxer'],
            ['name' => 'Jiujitsu'],
            ['name' => 'Wrestler'],
            ['name' => 'Kickboxer'],
            ['name' => 'Muay Thai'],
        ];

        if (! DB::table('martial_art_styles')->count()) {
            DB::table('martial_art_styles')->insert($martialArtStyles);
        }
    }
}
