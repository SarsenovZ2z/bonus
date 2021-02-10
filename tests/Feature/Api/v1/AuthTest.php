<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Site;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use SiteAuth;

    public function testBasicAuth()
    {
        $site = $this->getSite();

        $response = $this->authRequest($site)->getJson(route('api.v1.whoami'));

        $response->assertStatus(200);
        $response->assertJson($site->toArray());
    }
}
