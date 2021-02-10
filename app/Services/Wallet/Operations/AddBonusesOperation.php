<?php

namespace App\Services\Wallet\Operations;

use App\Models\Wallet;

trait AddBonusesOperation
{

    /**
     *
     *
     *
     */
    public function addBonuses(Wallet $wallet, $amount)
    {
        $wallet->update([
            'available' => $wallet->available + $amount,
        ]);
    }

}
