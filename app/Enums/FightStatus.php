<?php

namespace App\Enums;

enum FightStatus: string
{
    case Scheduled = 'scheduled';
    case Canceled = 'canceled';
    case Completed = 'completed';
}
