<?php

namespace ATM;

class WithdrawException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}