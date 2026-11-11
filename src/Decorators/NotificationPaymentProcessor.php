<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

class NotificationPaymentProcessor implements PaymentProcessor
{
    public function __construct(private PaymentProcessor $inner) {}

    public function pay(PaymentRequest $request): PaymentResult
    {
        $result = $this->inner->pay($request);
        echo "[NOTIFY] payment successful {$result->transactionId}\n";
        return $result;
    }
}