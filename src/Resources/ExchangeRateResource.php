<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Resources;

final readonly class ExchangeRateResource
{
    public function __construct(
        public string $currency,
        public string $baseCurrency,
        public float $buy,
        public float $sale,
    ) {
    }
}
