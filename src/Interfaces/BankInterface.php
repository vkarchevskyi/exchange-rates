<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Interfaces;

use Vkarchevskyi\ExchangeRates\Resources\ExchangeRateResource;

interface BankInterface
{
    /**
     * @param string[] $currencies
     * @return ExchangeRateResource[]
     */
    public function rates(array $currencies): array;
}
