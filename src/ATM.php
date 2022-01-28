<?php

namespace ATM;

use ATM\BalanceException;
use ATM\Withdraw;

class ATM
{
    private const TAX = 0.5;

    public function __construct(private User $user)
    {
    }

    public function withdraw(Withdraw $withdraw): string
    {
        if ($this->isNotMultipleOfFive($withdraw->value())) {
            throw new BalanceException('Is not five multiple');
        }

        $this->user->withdraw($withdraw->value());
        $this->taxFromUserBalance();

        return number_format($this->user->currentBalance(), 2);
    }

    private function isNotMultipleOfFive(int|float $value): bool
    {
        return $value % 5 !== 0;
    }

    private function taxFromUserBalance(): void
    {
        $this->user->withdraw(ATM::TAX);
    }
}
