<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

interface BankRepositoryInterface
{
    /**
     * @return object[]
     */
    public function getRates(): array;
}
