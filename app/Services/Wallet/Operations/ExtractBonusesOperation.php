<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\NotEnoughAvailableBonusesException;
use App\Exceptions\NotEnoughFrozenBonusesException;

use App\Models\Wallet;

trait ExtractBonusesOperation
{

    /**
     * Alias for extractAvailableBonuses
     *
     * @throws NotEnoughAvailableBonusesException
     */
    public function extract(Wallet $wallet, $amount)
    {
        return $this->extractAvailableBonuses($wallet, $amount);
    }

    /**
     *
     *
     * @throws NotEnoughAvailableBonusesException
     */
    public function extractAvailableBonuses(Wallet $wallet, $amount)
    {
        if (!$this->isEnoughAvailableBonuses($wallet, $amount)) {
            throw new NotEnoughAvailableBonusesException($wallet->available, $amount);
        }

        $wallet->update([
            'available' => $wallet->available - $amount
        ]);
    }

    /**
     *
     *
     * @throws NotEnoughFrozenBonusesException
     */
    public function extractFrozenBonuses(Wallet $wallet, $amount)
    {
        if (!$this->isEnoughFrozenBonuses($wallet, $amount)) {
            throw new NotEnoughFrozenBonusesException($wallet->available, $amount);
        }

        $wallet->update([
            'frozen' => $wallet->available - $amount
        ]);
    }

}
