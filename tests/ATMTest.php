<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{ATM, Balance, BalanceException, User};

class ATMTest extends TestCase
{
    /** @test */
    public function shouldCreateAtmMachine()
    {
        $user = new User();
        $atm = new ATM($user);

        $this->assertInstanceOf(ATM::class, $atm);
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function shouldWithdrawFromUserBalanceAccount()
    {
        $initialBalance = Balance::init(1000);
        $user = new User($initialBalance);
        $atm = new ATM($user);

        $value = 100;
        $finalBalance = $atm->withdraw($value);

        $this->assertEquals('899.50', $finalBalance);
    }

    /** @test */
    public function userShouldExposeHisBalance()
    {
        $initialBalance = Balance::init(0);
        $user = new User($initialBalance);

        $this->assertEquals(0, $user->currentBalance());
    }

    /** @test */
    public function balanceShouldChangeOnWithdraw()
    {
        $initialBalance = Balance::init(1000);
        $user = new User($initialBalance);
        $atm = new ATM($user);

        $value = 90;
        $finalBalance = $atm->withdraw($value);

        $this->assertEquals('909.50', $user->currentBalance());
        $this->assertEquals('909.50', $finalBalance);
    }

    /** @test */
    public function shouldFailedWithdrawValueIsFiveMultiple()
    {
        $this->expectException(BalanceException::class);
        $this->expectExceptionMessage('Is not five multiple');

        $initialBalance = Balance::init(1000);
        $user = new User($initialBalance);
        $atm = new ATM($user);

        $value = 91;
        $atm->withdraw($value);
    }
}
