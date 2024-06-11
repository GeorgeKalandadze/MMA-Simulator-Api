<?php

namespace App\Enums;

enum FightResult: string
{
    case Win = 'win';
    case Lose = 'lose';
    case Draw = 'draw';
}
