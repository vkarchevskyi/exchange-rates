<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data;

use Vkarchevskyi\ExchangeRates\Data\Privatbank\PrivatbankApiRateResource;

final readonly class PrivatbankApiResource
{
    /**
     * @param string $date
     * @param string $bank
     * @param string $baseCurrency
     * @param string $baseCurrencyLit
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
