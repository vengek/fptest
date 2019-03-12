<?php
require __DIR__ . '/vendor/autoload.php';

$parser = new \App\YandexPaymentMessageParser();
$paymentMessage = $parser->parse("Пароль: 2424\nСпишется 11,06р.\nПеревод на счет 410013834804253");

echo $paymentMessage->getAmount();