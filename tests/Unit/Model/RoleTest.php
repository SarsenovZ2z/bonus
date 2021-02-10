<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Role;

class RoleTest extends TestCase
{

    public function testCreate()
    {
        $role = Role::factory()->make();

        $this->assertTrue($role instanceof Role);
    }

    public function testUsersRelation()
    {
        $role = Role::factory()->hasUsers(3)->create();

        $this->assertEquals(3, $role->users()->count());
    }
}
