<?php

namespace Domain\Payment\Exceptions;

use Exception;

class PaymentProcessException extends Exception
{
    public static function paymentNotFound(): self
    {
        return new self('Payment not found');
    }
}
