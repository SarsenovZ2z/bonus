<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Wallet;

use OrderService;
use WalletService;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $site = $request->user();

        $client = Client::firstOrCreate($request->client);

        $wallet = Wallet::firstOrCreate([
            'client_id' => $client->id,
            'site_id' => $site->id
        ]);

        $order = OrderService::create($wallet, $request->order);

        return response()->json([
            'success' => true,
            'order' => $order,
        ], 201);
    }


    public function validateAmount(Request $request)
    {
        $site = $request->user();

        $client = Client::firstOrCreate($request->client);

        $wallet = Wallet::firstOrCreate([
            'client_id' => $client->id,
            'site_id' => $site->id
        ]);

        return response()->json([
            'valid' => WalletService::isEnoughAvailableBonuses($wallet, $request->amount),
        ]);
    }

}
