<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Contracts\FeePaymentProcessor;
use App\Contracts\LoggingPaymentProcessor;
use App\Contracts\NotificationPaymentProcessor;
use App\Dto\PaymentRequest;
use App\Services\CheckoutService;
use App\ValueObjects\Money;
use App\Strategies\CreditCardPayment;
use App\Strategies\BankTransferPayment;
use App\Strategies\EWalletPayment;

$request = new PaymentRequest(money: Money::of(amount: 150000, currency: 'VND'), orderId: 'ORD-001');

$processor = new CreditCardPayment(new BankTransferPayment(new EWalletPayment()));

$loggingProcessor = new LoggingPaymentProcessor($processor);
$feeProcessor = new FeePaymentProcessor($loggingProcessor, Money::of(amount: 10000, currency: 'VND'));
$notificationProcessor = new NotificationPaymentProcessor($feeProcessor);

$service = new CheckoutService($notificationProcessor);
$result = $service->process($request);
var_dump($result);
