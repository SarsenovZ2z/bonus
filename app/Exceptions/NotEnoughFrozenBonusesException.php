<?php

namespace App\Exceptions;

use Exception;

class NotEnoughFrozenBonusesException extends Exception
{

    public function __construct($frozen, $wanted)
    {
        parent::__construct(trans('errors.not_enough_frozen_bonuses', [
            'frozen' => $frozen,
            'wanted' => $wanted,
        ]));
    }


}
