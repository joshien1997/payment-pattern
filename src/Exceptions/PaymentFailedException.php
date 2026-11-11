<?php
declare(strict_types=1);

namespace App\Exceptions;

class PaymentFailedException extends \RuntimeException
{
    public function __construct(string $message = 'Payment failed')
    {
        parent::__construct($message);
    }
}