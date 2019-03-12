<?php

namespace App;

interface IPaymentMessageParser
{
    public function parse(string $string): PaymentMessage;
}
