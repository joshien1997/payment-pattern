<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

class LoggingPaymentProcessor implements PaymentProcessor
{
    public function __construct(private PaymentProcessor $inner) {}

    public function pay(PaymentRequest $request): PaymentResult
    {
        echo "[LOG] start {$request->money->amount} {$request->money->currency}\n";
        $result = $this->inner->pay($request);
        echo "[LOG] done {$result->transactionId}\n";
        return $result;
    }
}