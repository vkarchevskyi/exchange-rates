<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Resources\API\Privatbank;

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
