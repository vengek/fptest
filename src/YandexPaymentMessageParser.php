<?php

namespace App;

/**
 * Class YandexPaymentMessageParser
 * @package App
 */
class YandexPaymentMessageParser implements IPaymentMessageParser
{
    /**
     * @var string
     */
    private $confirmationCodePattern;

    /**
     * @var string
     */
    private $walletNumberPattern;

    /**
     * @var string
     */
    private $amountPattern;

    //всегда можно поменять паттерны при необходимости, там где собираются объекты(di контейнер например)
    //таким образом, в случае изменения текста сообщения не придётся лезть внутрь класса и менять его код.
    public function __construct(
        string $confirmationCodePattern = '#[\s]+\d{4}[\s]+#',
        string $amountPattern = '#\d+[.,]\d{1,2}?р\.#',
        string $walletNumberPattern = '#4100\d{8,11}#'
    )
    {
        $this->confirmationCodePattern = $confirmationCodePattern;
        $this->amountPattern = $amountPattern;
        $this->walletNumberPattern = $walletNumberPattern;
    }

    /**
     * @param string $text
     * @return PaymentMessage
     * @throws \Exception
     */
    public function parse(string $text): PaymentMessage
    {
        $isMatched = preg_match($this->confirmationCodePattern, $text, $code)
            && preg_match($this->walletNumberPattern, $text, $wallet)
            && preg_match($this->amountPattern, $text, $amount);

        if (!$isMatched) {
            throw new \Exception("can not parse message");
        }

        return new YandexPaymentMessage($wallet[0], $code[0], $amount[0]);
    }
}
