<?php

namespace ATM;

class BalanceException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
