<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\WeightDivision;

class CreateFighter
{
    public function execute($data, $user): Fighter
    {
        $weightDivision = WeightDivision::where('min_weight', '<=', $data['weight'])
            ->where('max_weight', '>=', $data['weight'])
            ->first();

        $fighter = new Fighter();
        $fighter->fill($data);
        $fighter->user_id = $user->id;
        $fighter->weight_division_id = $weightDivision->id;
        $fighter->save();




        return $fighter;
    }
}
