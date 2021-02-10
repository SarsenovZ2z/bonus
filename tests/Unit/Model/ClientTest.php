<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Client;
use App\Models\Wallet;
use App\Models\Transaction;

class ClientTest extends TestCase
{

    public function testCreate()
    {
        $client = Client::factory()->make();

        $this->assertTrue($client instanceof Client);
    }

    public function testWalletsRelation()
    {
        $client = Client::factory()->hasWallets(3)->create();

        $this->assertEquals(3, $client->wallets()->count());
    }

    public function testSitesRelation()
    {
        $client = Client::factory()->hasWallets(3)->create();

        $this->assertEquals(3, $client->sites()->count());
    }

    public function testTransactionsRelation()
    {
        $client = Client::factory()
                        ->has(
                            Wallet::factory()
                                  ->hasTransactions(2)
                                  ->count(2)
                        )->create();

        $this->assertEquals(4, $client->transactions()->count());
    }

}
