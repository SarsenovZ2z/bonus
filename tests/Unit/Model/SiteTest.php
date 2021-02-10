<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Site;
use App\Models\Wallet;
use App\Models\Transaction;

class SiteTest extends TestCase
{

    public function testCreate()
    {
        $site = Site::factory()->make();

        $this->assertTrue($site instanceof Site);
    }

    public function testUsersRelation()
    {
        $site = Site::factory()->hasUsers(3)->create();

        $this->assertEquals(3, $site->users()->count());
    }

    public function testWalletsRelation()
    {
        $site = Site::factory()->hasWallets(3)->create();

        $this->assertEquals(3, $site->wallets()->count());
    }

    public function testClientsRelation()
    {
        $site = Site::factory()->hasWallets(3)->create();

        $this->assertEquals(3, $site->clients()->count());
    }

    public function testTransactionsRelation()
    {
        $site = Site::factory()->has(Wallet::factory()->hasTransactions(2)->count(2))->create();

        $this->assertEquals(4, $site->transactions()->count());
    }

    public function testActionsRelation()
    {
        $site = Site::factory()->hasActions(3)->create();

        $this->assertEquals(3, $site->actions()->count());
    }

}
