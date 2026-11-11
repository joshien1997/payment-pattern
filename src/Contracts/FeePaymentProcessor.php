<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;
use App\ValueObjects\Money;

class FeePaymentProcessor implements PaymentProcessor
{
    public function __construct(private PaymentProcessor $inner, private Money $fee,) {}

    public function pay(PaymentRequest $request): PaymentResult
    {
        $newMoney = $request->money->add($this->fee);
        $newRequest = new PaymentRequest($newMoney, $request->orderId);
        echo "[FEE] {$request->money->amount} -> {$newMoney->amount}\n";
        return $this->inner->pay($newRequest);
    }
}
