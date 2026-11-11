<?php

declare(strict_types=1);

namespace App\Strategies;

use App\Contracts\PaymentProcessor;
use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

abstract class AbstractPaymentStrategy implements PaymentProcessor
{
    public function __construct(
        protected readonly ?PaymentProcessor $fallback = null,
    ) {}

    public function pay(PaymentRequest $request): PaymentResult
    {
        try {
            return $this->exec($request);
        } catch (\Exception $e) {
            return $this->fallback?->pay($request) ?? new PaymentResult(false, 'Payment failed', $e->getMessage());
        }
    }

    abstract public function exec(PaymentRequest $request): PaymentResult;
}