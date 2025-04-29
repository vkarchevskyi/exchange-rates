<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Resources\API;

final class MonobankApiResource
{
    public function __construct(
        public int $currencyCodeA,
        public int $currencyCodeB,
        public int $date,
        public ?float $rateSell,
        public ?float $rateBuy,
        public ?float $rateCross,
    ) {
    }
}
