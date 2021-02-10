<?php

namespace App\Observers;

use App\Models\Transaction;

use App\Models\Action;
use TransactionService;

class TransactionObserver
{

    public function created(Transaction $transaction)
    {
        $transaction->actions()->create([
            'action' => Action::CREATED,
            'reason' => '',
        ]);
    }

    public function updated(Transaction $transaction)
    {
        if ($transaction->isCanceled() && !TransactionService::isCanceledStatus($transaction->getOriginal('status'))) {
            $transaction->fireCanceledEvent();
        }

        if ($transaction->isSuccess() && !Transaction::isSuccessStatus($transaction->getOriginal('status'))) {
            $transaction->fireSucceedEvent();
        }
    }

    public function succeed(Transaction $transaction)
    {
        // TODO:
        $transaction->actions()->create([
            'action' => Action::SUCCEED,
            'reason' => '',
        ]);
    }

    public function canceled(Transaction $transaction)
    {
        // TODO:
        $transaction->actions()->create([
            'action' => Action::CANCELED,
            'reason' => '',
        ]);
    }

}
