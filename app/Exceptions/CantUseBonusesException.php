<?php

namespace App\Exceptions;

use Exception;

class CantUseBonusesException extends Exception
{

    public function __construct($wanted)
    {
        parent::__construct(trans('errors.cant_use_bonuses', [
            'wanted' => $wanted,
        ]));
    }

}
