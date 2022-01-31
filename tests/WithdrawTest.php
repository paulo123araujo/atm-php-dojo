<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{Withdraw, WithdrawException};

class WithdrawTest extends TestCase
{
    /** @test */
    public function shouldCreateWithdrawCorrectly()
    {
        $withdrawValue = 1;
        $withdraw = Withdraw::init($withdrawValue);

        $this->assertInstanceOf(Withdraw::class, $withdraw);
        $this->assertEquals(1, $withdraw->value());
    }

    /** @test */
    public function shouldThrowExceptionIfWithdrawIsLessOrEqualZero()
    {
        $this->expectException(WithdrawException::class);
        $this->expectExceptionMessage('Withdraw should be greater than zero');

        $withdrawValue = 0;

        $withdraw = Withdraw::init($withdrawValue);
    }

    /** @test */
    public function shouldThrowExceptionIfWithdrawIsGreaterThan2000()
    {
        $this->expectException(WithdrawException::class);
        $this->expectExceptionMessage('Withdraw should be less or equal than 2000');

        $withdrawValue = 2001;

        Withdraw::init($withdrawValue);
    }
}
