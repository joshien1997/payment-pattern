<?php
declare(strict_types=1);

namespace App\Dto;

use App\ValueObjects\Money;

final class PaymentRequest
{

    public function __construct(
        public readonly Money $money,
        public readonly string $orderId
    ) {
    }
}