<?php

namespace ATM;

use ATM\WithdrawException;

class Withdraw
{
    private function __construct(private int|float $withdraw) 
    {
        $this->validate();
    }

    public static function init(int|float $withdraw): Withdraw
    {
        return new Withdraw($withdraw);
    }

    public function value(): int|float
    {
        return $this->withdraw;
    }

    private function validate(): void
    {
        if ($this->withdraw <= 0) {
            throw new WithdrawException("Withdraw should be greater than zero");
        }

        if ($this->withdraw > 2000) {
            throw new WithdrawException('Withdraw should be less or equal than 2000');
        }
    }
}