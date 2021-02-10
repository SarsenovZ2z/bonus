<?php

namespace App\Services\Transaction\Operations;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\Wallet;

use WalletService;

trait CreateOperation
{

    /**
     *
     *
     * @return Transaction
     */
    public function create(Wallet $wallet, $amount, Order $order = null) : Transaction
    {

        try {
            \DB::beginTransaction();

            $transaction = new Transaction;
            $transaction->amount = $amount;
            $transaction->wallet_id = $wallet->id;
            $transaction->order_id = optional($order)->id;
            $transaction->status = $this->needsVerification($transaction) ? Transaction::NOT_VERIFIED : Transaction::PENDING;
            $transaction->save();

            $this->processTransaction($transaction);

            \DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    /**
     *
     *
     *
     */
    public function processTransaction(Transaction $transaction)
    {
        if ($this->shouldFreeze($transaction)) {
            WalletService::freeze($transaction->wallet, abs($transaction->amount));
        }

        if ($this->needsVerification($transaction)) {
            $this->sendVerification($transaction);
        }
    }


    /**
     *
     *
     * @return bool
     */
    public function shouldFreeze(Transaction $transaction) : bool
    {
        return $this->isExtracting($transaction);
    }


}
