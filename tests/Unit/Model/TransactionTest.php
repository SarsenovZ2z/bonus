<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Order;
use App\Models\Client;

class TransactionTest extends TestCase
{

    public function testCreate()
    {
        $transaction = Transaction::factory()->make();

        $this->assertTrue($transaction instanceof Transaction);
    }

    public function testWalletRelation()
    {
        $transaction = Transaction::factory()->make();

        $this->assertTrue($transaction->wallet instanceof Wallet);
    }

    public function testOrderRelation()
    {
        $transaction = Transaction::factory()->make();

        $this->assertTrue($transaction->order instanceof Order);
    }

    public function testActionsRelation()
    {
        $transaction = Transaction::factory()->hasActions(3)->create();

        $this->assertTrue(3 <= $transaction->actions()->count());
    }


}
