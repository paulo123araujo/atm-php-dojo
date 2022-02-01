<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ATM\{Balance, BalanceException, Withdraw, WithdrawException, User};

class UserTest extends TestCase
{
    /** @test */
    public function userShouldExposeHisBalance()
    {
        $initialValue = 0;
        $initialBalance = Balance::init($initialValue);
        $user = new User($initialBalance);

        $this->assertEquals(0, $user->currentBalance());
    }

    /** @test */
    public function shouldWithdrawCorrectlyFromUser()
    {
        $initialValue = 1000;
        $initialBalance = Balance::init($initialValue);
        $user = new User($initialBalance);

        $this->assertEquals(1000, $user->currentBalance());

        $withdrawValue = 100;
        $user->withdraw(Withdraw::init($withdrawValue));

        $this->assertEquals(900, $user->currentBalance());
    }
}
