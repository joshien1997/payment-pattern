<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\PaymentProcessor;
use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

class CheckoutService
{
    public function __construct(protected readonly PaymentProcessor $paymentProcessor) {}

    public function process(PaymentRequest $request): PaymentResult
    {
        return $this->paymentProcessor->pay($request);
    }
}