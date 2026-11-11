<?php

declare(strict_types=1);

namespace App\ValueObjects;

final class Money
{
    private function __construct(
        public readonly int $amount,
        public readonly string $currency,
    ) {
        self::assertAmount($amount);
        self::assertCurrency($currency);
    }

    public static function of(int $amount, string $currency): self
    {
        return new self($amount, $currency);
    }

    public function add(self $other): self
    {
        return new self($this->amount + $other->amount, $this->currency);
    }

    private static function assertAmount(float $amount): void
    {
        if (!is_finite($amount) || $amount <= 0) {
            throw new \InvalidArgumentException('Amount must be a positive number.');
        }
    }

    private static function assertCurrency(string $currency): void
    {
        if (preg_match('/^[A-Z]{3}$/', $currency) !== 1) {
            throw new \InvalidArgumentException('Currency must be a 3-letter ISO 4217 code.');
        }
    }
}
