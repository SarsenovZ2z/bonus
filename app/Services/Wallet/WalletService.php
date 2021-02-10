<?php

namespace App\Services\Wallet;

use App\Services\Wallet\Operations\AddBonusesOperation;
use App\Services\Wallet\Operations\ExtractBonusesOperation;
use App\Services\Wallet\Operations\FreezeBonusesOperation;
use App\Services\Wallet\Operations\UnfreezeBonusesOperation;

use App\Models\Wallet;

class WalletService
{
    use AddBonusesOperation, ExtractBonusesOperation, FreezeBonusesOperation, UnfreezeBonusesOperation;

    /**
     *
     *
     * @return bool
     */
    public function isEnoughAvailableBonuses(Wallet $wallet, $amount) : bool
    {
        return $wallet->available >= $amount;
    }

    /**
     *
     *
     * @return bool
     */
    public function isEnoughFrozenBonuses(Wallet $wallet, $amount) : bool
    {
        return $wallet->frozen >= $amount;
    }


}
