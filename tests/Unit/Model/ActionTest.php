<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Action;
use App\Models\User;
use App\Models\Site;
use App\Models\Transaction;

class ActionTest extends TestCase
{

    public function testCreate()
    {
        $action = Action::factory()->make();

        $this->assertTrue($action instanceof Action);
    }

    public function testTransactionRelation()
    {
        $action = Action::factory()->create();

        $this->assertTrue($action->transaction instanceof Transaction);
    }

    public function testResponsibleRelation()
    {
        $action = Action::factory()->create();

        $this->assertTrue($action->responsible instanceof User || $action->responsible instanceof Site);
    }

}
