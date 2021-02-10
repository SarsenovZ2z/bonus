<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Wallet;

use TransactionService;

class OrderService
{

    /**
     *
     *
     * @return Order
     */
    public function create(Wallet $wallet, array $orderData) : Order
    {
        try {
            \DB::beginTransaction();

            $order = Order::create($orderData);
            $this->processOrder($order, $wallet);

            \DB::commit();
            return $order;
        } catch(\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    /**
     *
     *
     */
    public function processOrder(Order $order, Wallet $wallet)
    {
        if ($extract = $this->calculateUsedBonuses($order)) {
            TransactionService::create($wallet, -$extract, $order);
        }

        if ($add = $this->calculateCashback($order)) {
            TransactionService::create($wallet, $add, $order);
        }
    }



    /**
     *
     *
     * @return bool
     */
    public function isUsingBonuses(Order $order) : bool
    {
        return $order->used > 0;
    }


    /**
     *
     *
     * @return bool
     */
    public function shouldAddBonuses(Order $order) : bool
    {
        return !$this->isUsingBonuses($order);
    }

    /**
     *
     *
     * @return bool
     */
    public function shouldExtractBonuses(Order $order) : bool
    {
        return $this->isUsingBonuses($order);
    }

    /**
     *
     * @return mixed
     */
    public function calculateCashback(Order $order)
    {
        $total = $order->total - ($order->used ?? 0);
        return $this->shouldAddBonuses($order) ? ($total * $order->cashback / 100) : false;
    }

    /**
     *
     * @return mixed
     */
    public function calculateUsedBonuses(Order $order)
    {
        return $this->shouldExtractBonuses($order) ? $order->used : false;
    }


}
