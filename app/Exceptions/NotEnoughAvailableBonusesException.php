<?php

namespace App\Exceptions;

use Exception;

class NotEnoughAvailableBonusesException extends Exception
{

    public function __construct($available, $wanted)
    {
        parent::__construct(trans('errors.not_enough_bonuses', [
            'available' => $available,
            'wanted' => $wanted
        ]));
    }

}
