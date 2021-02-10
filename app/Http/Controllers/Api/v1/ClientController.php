<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\v1\ClientResource;

use App\Models\Client;

class ClientController extends Controller
{

    /**
     *
     * @return bool
     */
    public function check(Request $request)
    {
        return response()->json([
            'exists' => $request->user()->clients()->phone($request->phone)->exists()
        ]);
    }

    /**
     *
     * @return ClientResource
     */
    public function show(Request $request)
    {
        $client = $request->user()->clients()->findByPhoneOrFail($request->phone);
        return response()->json(new ClientResource($client));
    }

    /**
     *
     * @return ClientResource
     */
    public function search(Request $request)
    {
        $client = Client::findByPhoneOrFail($request->phone);
        return response()->json(new ClientResource($client));
    }

    /**
     *
     * @return ClientResource
     */
    public function store(Request $request)
    {
        $site = $request->user();

        try {
            $client = $site->clients()->create([
                'phone'     => $request->phone,
                'name'      => $request->name,
            ]);
            return response()->json(new ClientResource($client), 201);
        } catch (\Exception $e) {
            abort(400, 'Client already exists!');
        }
    }

}
