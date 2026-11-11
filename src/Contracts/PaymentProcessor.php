<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

interface PaymentProcessor
{
    public function pay(PaymentRequest $request): PaymentResult;
}