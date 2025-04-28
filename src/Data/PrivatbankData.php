<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data;

final readonly class PrivatbankData
{
    public function __construct(
        public string $baseCurrency,
        public string $currency,
        public float $saleRate,
        public float $purchaseRate,
    ) {
    }
}
