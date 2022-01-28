<?php

namespace ATM;

use ATM\{Balance, Withdraw};

class User
{
    private Balance $balance;

    public function __construct(Balance|null $initialBalance = null)
    {
        $this->balance = $initialBalance ?? Balance::init(0);
    }

    public function currentBalance(): int|float
    {
        return $this->balance->value();
    }

    public function withdraw(Withdraw $withdraw): void
    {
        $this->balance = Balance::init($this->balance->value() - $withdraw->value());
    }
}
