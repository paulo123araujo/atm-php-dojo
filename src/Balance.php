<?php

namespace ATM;

use ATM\BalanceException;

class Balance
{
    private function __construct(private int|float $balance)
    {
        $this->validate();
    }

    public static function init(int|float $balance): Balance
    {
        return new Balance($balance);
    }

    private function validate(): void
    {
        if ($this->balance < 0) {
            throw new BalanceException('Balance should be greater than zero');
        }

        if ($this->balance > 2000) {
            throw new BalanceException('Balance should be equal or lower than 2000');
        }
    }

    public function value(): int|float
    {
        return $this->balance;
    }
}
