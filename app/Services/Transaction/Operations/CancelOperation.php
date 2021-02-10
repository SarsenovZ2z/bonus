<?php

namespace App\Services\Transaction\Operations;

use App\Models\Transaction;

trait CancelOperation
{

    /**
     *
     *
     */
    public function cancelTransaction(Transaction $transaction)
    {
        $this->validateCancel($transaction);
        // TODO:
        $transaction->status = Transaction::CANCELED;
        $transaction->save();
    }

    /**
     *
     * @return bool
     */
    public function canCancel(Transaction $transaction) : bool
    {
        try {
            $this->validateCancel($transaction);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     *
     * @throws Exception
     */
    public function validateCancel(Transaction $transaction)
    {
        if ($transaction->isCanceled()) {
            throw new \Exception('Aleady canceled!');
        }
    }

}
