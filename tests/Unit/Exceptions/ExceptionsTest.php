<?php

namespace Tests\Unit\Exceptions;

use Tests\TestCase;

use App\Exceptions\CantUseBonusesException;
use App\Exceptions\NotEnoughAvailableBonusesException;
use App\Exceptions\NotEnoughFrozenBonusesException;

class ExceptionsTest extends TestCase
{

    public function testCantUseBonusesException()
    {
        $e = new CantUseBonusesException(1000);
        $this->assertEquals(trans('errors.cant_use_bonuses', [
            'wanted' => 1000
        ]), $e->getMessage());
    }

    public function testNotEnoughAvailableBonusesException()
    {
        $e = new NotEnoughAvailableBonusesException(100, 1000);
        $this->assertEquals(trans('errors.not_enough_bonuses', [
            'available' => 100,
            'wanted' => 1000,
        ]), $e->getMessage());
    }

    public function testNotEnoughFrozenBonusesException()
    {
        $e = new NotEnoughFrozenBonusesException(100, 1000);
        $this->assertEquals(trans('errors.not_enough_frozen_bonuses', [
            'frozen' => 100,
            'wanted' => 1000,
        ]), $e->getMessage());
    }
}
