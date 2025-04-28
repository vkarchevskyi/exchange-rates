<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data\Privatbank;

final readonly class PrivatbankApiRateResource
{
    public function __construct(
        public string $baseCurrency,
        public string $currency,
        public float $saleRateNB,
        public float $purchaseRateNB,
        public float $saleRate,
        public float $purchaseRate,
    ) {
    }
}
