<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Wallet;
use App\Models\Client;
use App\Models\Site;
use App\Models\Transaction;

class WalletTest extends TestCase
{

    public function testCreate()
    {
        $wallet = Wallet::factory()->make();

        $this->assertTrue($wallet instanceof Wallet);
    }

    public function testClientRelation()
    {
        $wallet = Wallet::factory()->make();

        $this->assertTrue($wallet->client instanceof Client);
    }

    public function testSiteRelation()
    {
        $wallet = Wallet::factory()->make();

        $this->assertTrue($wallet->site instanceof Site);
    }

    public function testTransactionsRelation()
    {
        $wallet = Wallet::factory()->hasTransactions(3)->create();

        $this->assertEquals(3, $wallet->transactions()->count());
    }

    public function testOrderRelation()
    {
        $wallet = Wallet::factory()->hasTransactions(3)->create();

        $this->assertEquals(3, $wallet->orders()->count());
    }

    public function testActionsRelation()
    {
        $wallet = Wallet::factory()->has(Transaction::factory()->hasActions(2)->count(2))->create();

        $this->assertTrue(4 <= $wallet->actions()->count());
    }

}
