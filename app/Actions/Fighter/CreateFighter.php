<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;

class CreateFighter
{

    public function execute($data, $user): Fighter
    {
        $fighter = new Fighter();
        $fighter->fill($data);
        $fighter->user_id = $user->id;
        $fighter->save();

        return $fighter;
    }
}
