<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Vkarchevskyi\ExchangeRates\Data\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository
{
    public function __construct(private FetchService $fetch)
    {
    }

    /**
     * @return MonobankApiResource[]
     * @throws ConnectionException
     * @throws ApiException
     */
    public function getData(): array
    {
        return MonobankApiResource::collect(
            $this->fetch->run(Config::string('exchange-rates.banks.monobank.endpoint'))
        );
    }
}
