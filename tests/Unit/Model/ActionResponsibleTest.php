<?php

namespace Tests\Unit\Model;

use Tests\TestCase;

use App\Models\Action;
use App\Models\User;
use App\Models\Site;

use Auth;

class ActionResponsibleTest extends TestCase
{

    public function testEmptyResponsible()
    {
        $action = Action::factory()->state([
            'responsible_type' => null,
        ])->create();

        $this->assertNull($action->responsible);
    }

    public function testResponsibleUser()
    {
        $user = User::factory()->create();

        Auth::shouldUse('web');
        Auth::login($user);

        $action = Action::factory()->create();

        $this->assertTrue($action->responsible instanceof User);
    }

    public function testResponsibleSite()
    {
        $site = Site::factory()->create();

        Auth::shouldUse('api');
        Auth::guard('api')->login($site);

        $action = Action::factory()->create();

        $this->assertTrue($action->responsible instanceof Site);
    }

}
