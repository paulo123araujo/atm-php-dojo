<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{ATM, Balance, BalanceException, Withdraw, WithdrawException, User};

class ATMTest extends TestCase
{
    /**
     * @return array{ATM,User}
     */
    private function createATMAndUserInstances(Balance $balance): array
    {
        $user = new User($balance);
        $atm = new ATM($user);

        return [$atm, $user];
    }

    /** @test */
    public function shouldCreateAtmMachine()
    {
        $initialBalance = 0;

        [$atm, $user] = $this->createATMAndUserInstances(Balance::init($initialBalance));

        $this->assertInstanceOf(ATM::class, $atm);
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function shouldWithdrawFromUserBalanceAccount()
    {
        $initialBalance = 1000;

        [$atm, $user] = $this->createATMAndUserInstances(Balance::init($initialBalance));

        $value = 100;
        $finalBalance = $atm->withdraw(Withdraw::init($value));

        $this->assertEquals('899.50', $finalBalance);
    }

    /** @test */
    public function balanceShouldChangeOnWithdraw()
    {
        $initialBalance = 1000;

        [$atm, $user] = $this->createATMAndUserInstances(Balance::init($initialBalance));

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

        $initialBalance = 1000;
        [$atm, $user] = $this->createATMAndUserInstances(Balance::init($initialBalance));

        $value = 91;
        $atm->withdraw(Withdraw::init($value));
    }
}
