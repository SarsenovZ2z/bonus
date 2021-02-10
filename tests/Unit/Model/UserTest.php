<?php

namespace Tests\Unit\Model;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function testCreate()
    {
        $user = User::factory()->make();

        $this->assertTrue($user instanceof User);
    }

    public function testSitesRelation()
    {
        $user = User::factory()->hasSites(3)->create();

        $this->assertEquals(3, $user->sites()->count());
    }

    public function testRoleRelation()
    {
        $user = User::factory()->hasRoles(3)->create();

        $this->assertEquals(3, $user->roles()->count());
    }

    public function testActionsRelation()
    {
        $user = User::factory()->hasActions(3)->create();

        $this->assertEquals(3, $user->actions()->count());
    }

}
