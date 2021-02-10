<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Resources\Api\v1\ClientResource;
use App\Models\Client;
use App\Models\Site;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    use SiteAuth;

    public function testClientNotFound()
    {
        $response = $this->authRequest()->json('GET', route('api.v1.client.show'), ['phone' => 'INVALID_PHONE']);
        $response->assertNotFound();
    }

    public function testShowClient()
    {
        $client = Client::factory()->hasSites(1)->create();
        $site = $client->sites()->first();

        $response = $this->authRequest($site)->json('GET', route('api.v1.client.show'), ['phone' => $client->phone]);
        $response->assertJson(['id' => $client->id]);
    }

    public function testSearchClient()
    {
        $client = Client::factory()->create();
        $site = Site::factory()->create();

        $response = $this->authRequest($site)->json('GET', route('api.v1.client.search'), ['phone' => $client->phone]);
        $response->assertJson(['id' => $client->id]);
    }

    public function testCheckClient()
    {
        $client = Client::factory()->hasSites(1)->create();
        $site = $client->sites()->first();

        $response = $this->authRequest($site)->json('GET', route('api.v1.client.check'), ['phone' => $client->phone]);
        $response->assertJsonPath('exists', true);

        $response = $this->authRequest($site)->json('GET', route('api.v1.client.check'), ['phone' => 'INVALID_PHONE']);
        $response->assertJsonPath('exists', false);
    }

    public function testCreateClient()
    {
        $data = [
            'phone' => '77753028045',
            'name'  => 'Nurdaulet',
        ];

        $response = $this->authRequest()->postJson(route('api.v1.client.create'), $data);
        $response->assertStatus(201);
    }

    public function testCreateClientError()
    {
        $client = Client::factory()->hasSites(1)->create();
        $site = $client->sites()->first();
        $data = [
            'phone' => $client->phone,
            'name'  => $client->name,
        ];

        $response = $this->authRequest($site)->postJson(route('api.v1.client.create'), $data);
        $response->assertStatus(400);
    }

}
