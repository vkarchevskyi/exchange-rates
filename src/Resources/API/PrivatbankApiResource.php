<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data;

use Spatie\LaravelData\Resource;
use Vkarchevskyi\ExchangeRates\Data\Privatbank\PrivatbankApiRateResource;

final class PrivatbankApiResource extends Resource
{
    /**
     * @param PrivatbankApiRateResource[] $exchangeRate
     */
    public function __construct(
        public string $date,
        public string $bank,
        public string $baseCurrency,
        public string $baseCurrencyLit,
        public array $exchangeRate,
    ) {
    }
}
