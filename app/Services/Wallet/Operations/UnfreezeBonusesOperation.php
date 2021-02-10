<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\NotEnoughFrozenBonusesException;

use App\Model\Wallet;

trait UnfreezeBonusesOperation
{

    /**
     *
     *
     * @throws NotEnoughFrozenBonusesException
     */
    public function unfreeze(Wallet $wallet, $amount)
    {
        if (!$this->isEnoughFrozenBonuses($wallet, $amount)) {
            throw new NotEnoughFrozenBonusesException($wallet->available, $amount);
        }

        $wallet->update([
            'available' => $wallet->available + $amount,
            'frozen' => $wallet->frozen - $amount,
        ]);
    }

}
