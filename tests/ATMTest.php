<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{ATM, Balance, BalanceException, Withdraw, WithdrawException, User};

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
        $finalBalance = $atm->withdraw(Withdraw::init($value));

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
        $finalBalance = $atm->withdraw(Withdraw::init($value));

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
        $atm->withdraw(Withdraw::init($value));
    }

    /** @test */
    public function shouldFailedIfBalanceLessThanZero()
    {
        $this->expectException(BalanceException::class);
        $this->expectExceptionMessage('Balance should be greater than zero');

        $initialBalance = Balance::init(-1);
    }

    /** @test */
    public function shouldThrowExceptionIfBalanceIsGreaterThan2000()
    {
        $this->expectException(BalanceException::class);
        $this->expectExceptionMessage('Balance should be equal or lower than 2000');

        $initialBalance = Balance::init(2001);
    }

    /** @test */
    public function shouldCreateBalance() 
    {
        $balance = Balance::init(1);

        $this->assertInstanceOf(Balance::class, $balance);
        $this->assertEquals(1, $balance->value());
    }

    /** @test */
    public function shouldCreateWithdrawCorrectly()
    {
        $withdraw = Withdraw::init(1);

        $this->assertInstanceOf(Withdraw::class, $withdraw);
        $this->assertEquals(1, $withdraw->value());
    }

    /** @test */
    public function shouldThrowExceptionIfWithdrawIsLessOrEqualZero()
    {
        $this->expectException(WithdrawException::class);
        $this->expectExceptionMessage('Withdraw should be greater than zero');

        $withdraw = Withdraw::init(0);
    }

    /** @test */
    public function shouldThrowExceptionIfWithdrawIsGreaterThan2000()
    {
        $this->expectException(WithdrawException::class);
        $this->expectExceptionMessage('Withdraw should be less or equal than 2000');

        Withdraw::init(2001);
    }
}
