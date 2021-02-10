<?php

namespace App\Services\Transaction\Facades;

use Illuminate\Support\Facades\Facade;

class Transaction extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'transaction';
    }

}
