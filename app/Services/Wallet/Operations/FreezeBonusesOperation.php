<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\NotEnoughAvailableBonusesException;

use App\Models\Wallet;

trait FreezeBonusesOperation
{
    /**
     *
     *
     * @throws NotEnoughAvailableBonusesException
     */
    public function freeze(Wallet $wallet, $amount)
    {
        if (!$this->isEnoughAvailableBonuses($wallet, $amount)) {
            throw new NotEnoughAvailableBonusesException($wallet->frozen, $amount);
        }

        $wallet->update([
            'available' => $wallet->available - $amount,
            'frozen' => $wallet->frozen + $amount,
        ]);
    }

}
