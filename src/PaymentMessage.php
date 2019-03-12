<?php

namespace App;

abstract class PaymentMessage
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $wallet;

    public function __construct(string $wallet, string $code, string $amount)
    {
        $this->code = $code;
        $this->amount = $amount;
        $this->wallet = $wallet;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getWallet(): string
    {
        return $this->wallet;
    }
}
