<?php

namespace Tests\Feature\Api\v1;

use App\Models\Site;

trait SiteAuth
{

    public function authRequest($site = null, array $headers = [])
    {
        return $this->withHeaders(array_merge($headers, $this->getAuthHeaders($site ?: $this->getSite())));
    }

    public function getAuthHeaders(Site $site) : array
    {
        return [
            'Authorization' => 'Basic '.base64_encode("{$site->key}:password"),
        ];
    }

    public function getSite() : Site
    {
        return Site::factory()->create();
    }

}
