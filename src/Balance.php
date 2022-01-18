<?php

namespace ATM;

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
            throw new \Exception('Balance should be greater than zero');
        }
    }

    public function value(): int|float
    {
        return $this->balance;
    }
}
