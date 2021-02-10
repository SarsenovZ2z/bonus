<?php

namespace App\Services\Transaction;

use App\Services\Transaction\Operations\CreateOperation;
use App\Services\Transaction\Operations\CancelOperation;
use App\Services\Transaction\Operations\VerifyOperation;

use App\Models\Transaction;

class TransactionService
{
    use CreateOperation, VerifyOperation, CancelOperation;

    /**
     *
     *
     * @return bool
     */
    public function isExtracting(Transaction $transaction) : bool
    {
        return $transaction->amount < 0;
    }

}
