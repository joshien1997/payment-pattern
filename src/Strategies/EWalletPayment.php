<?php

declare(strict_types=1);

namespace App\Strategies;

use App\Dto\PaymentRequest;
use App\Dto\PaymentResult;

class EWalletPayment extends AbstractPaymentStrategy
{
    public function exec(PaymentRequest $request): PaymentResult
    {
        return new PaymentResult(
            success: true,
            transactionId: '1234567890',
            message: "Paid {$request->money->amount} {$request->money->currency} by e-wallet"
        );
    }
}
