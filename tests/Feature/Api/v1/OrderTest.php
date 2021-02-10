<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Site;
use App\Models\Wallet;
use App\Models\Transaction;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use SiteAuth;

    /**
     * @dataProvider createOrderDataProvider
     */
    public function testCreateOrder($order, $expectedAmount, $expectedStatus)
    {
        if ($expectedAmount < 0) {
            $client = Client::factory()->has(Wallet::factory()->state(['available' => 1000]))->create();
            $site = $client->sites()->first();
        } else {
            $client = Client::factory()->create();
            $site = Site::factory()->create();
        }

        $data = [
            'client' => [
                'phone' => $client->phone,
            ],
            'order' => $order
        ];
        $response = $this->authRequest($site)->postJson(route('api.v1.order.create'), $data);

        $response->assertStatus(201);
        $response->assertJsonPath('success', true);
        // $response->assertJsonPath('transaction.amount', $expectedAmount);
        // $response->assertJsonPath('transaction.status', $expectedStatus);
    }

    /**
     * @dataProvider validateAmountDataProvider
     */
    public function testValidateAmount($amount, $expected)
    {
        $client = Client::factory()->has(Wallet::factory()->state(['available' => 1000]))->create();
        $site = $client->sites()->first();

        $data = [
            'client' => [
                'phone' => $client->phone,
            ],
            'amount' => $amount
        ];

        $response = $this->authRequest($site)->json('GET', route('api.v1.order.validate'), $data);
        $response->assertStatus(200);
        $response->assertJsonPath('valid', $expected);
    }

    public function validateAmountDataProvider() : array
    {
        return [
            [200, true],
            [1000, true],
            [1100, false]
        ];
    }

    public function createOrderDataProvider() : array
    {
        return [
            'test cashback' => [
                [
                    'total' => 14000,
                    'cashback' => 5,
                    'used' => 0,
                    'extras' => [
                        'id' => 123,
                    ],
                ],
                14000 * 5 / 100,// amount
                Transaction::PENDING,// status
            ],
            'test used' => [
                [
                    'total' => 14000,
                    'cashback' => 5,
                    'used' => 1000,
                    'extras' => [
                        'id' => 123,
                    ],
                ],
                -1000,
                Transaction::NOT_VERIFIED,
            ],
        ];
    }

}
