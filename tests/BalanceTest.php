<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{Balance, BalanceException};

class BalanceTest extends TestCase
{
    /** @test */
    public function shouldFailedIfBalanceLessThanZero()
    {
        $this->expectException(BalanceException::class);
        $this->expectExceptionMessage('Balance should be greater than zero');

        $initialValue = -1;
        $initialBalance = Balance::init($initialValue);
    }

    /** @test */
    public function shouldThrowExceptionIfBalanceIsGreaterThan2000()
    {
        $this->expectException(BalanceException::class);
        $this->expectExceptionMessage('Balance should be equal or lower than 2000');

        $initialValue = 2001;
        $initialBalance = Balance::init($initialValue);
    }

    /** @test */
    public function shouldCreateBalance()
    {
        $initialValue = 1;
        $balance = Balance::init($initialValue);

        $this->assertInstanceOf(Balance::class, $balance);
        $this->assertEquals(1, $balance->value());
    }
}
