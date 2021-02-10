<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Wallet;

class OrderTest extends TestCase
{

    public function testCreate()
    {
        $order = Order::factory()->make();

        $this->assertTrue($order instanceof Order);
    }

    public function testTransactionsRelation()
    {
        $order = Order::factory()->hasTransactions(3)->create();

        $this->assertEquals(3, $order->transactions()->count());
    }

}
