<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                'name' => 'Striking',
                'description' => 'Skill in striking techniques such as punches, kicks, and elbows.',
                'price' => 50.00,
            ],
            [
                'name' => 'Grappling',
                'description' => 'Skill in grappling techniques such as throws, takedowns, and submissions.',
                'price' => 60.00,
            ],
            [
                'name' => 'Wrestling',
                'description' => 'Skill in wrestling techniques such as takedowns, pins, and reversals.',
                'price' => 55.00,
            ],
            [
                'name' => 'Jiu-Jitsu',
                'description' => 'Skill in Brazilian Jiu-Jitsu techniques such as joint locks and chokeholds.',
                'price' => 70.00,
            ],
            [
                'name' => 'Muay Thai',
                'description' => 'Skill in Muay Thai techniques such as knee strikes, clinching, and sweeps.',
                'price' => 65.00,
            ],
            [
                'name' => 'Boxing',
                'description' => 'Skill in the art of boxing, including punches, footwork, and defensive techniques.',
                'price' => 55.00,
            ],
            [
                'name' => 'Kickboxing',
                'description' => 'Skill combining elements of boxing and various kicking techniques.',
                'price' => 60.00,
            ],
            [
                'name' => 'Karate',
                'description' => 'Skill in the traditional Japanese martial art of Karate, emphasizing striking techniques with hands and feet.',
                'price' => 65.00,
            ],
            [
                'name' => 'Taekwondo',
                'description' => 'Skill in the Korean martial art of Taekwondo, known for its emphasis on kicking techniques.',
                'price' => 60.00,
            ],
            [
                'name' => 'Capoeira',
                'description' => 'Skill in the Afro-Brazilian martial art of Capoeira, combining elements of dance, acrobatics, and music.',
                'price' => 70.00,
            ],
        ];

        if (! DB::table('skills')->count()) {
            DB::table('skills')->insert($skills);
        }
    }
}
