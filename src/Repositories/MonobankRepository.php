<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use JsonException;
use Throwable;
use Vkarchevskyi\ExchangeRates\Data\MonobankData;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Services\WithFetchAndMap;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository implements BankRepositoryInterface
{
    /** @use WithFetchAndMap<MonobankData> */
    use WithFetchAndMap;

    public function __construct(
        private Factory $http,
        #[Config('services.monobank.base_url')]
        private string $baseUrl,
        #[Config('services.monobank.endpoints.currency')]
        private string $endpointUrl
    ) {
    }

    /**
     * @return MonobankData[]
     * @throws ConnectionException
     * @throws JsonException
     * @throws Throwable
     * @throws ApiException
     */
    public function getRates(): array
    {
        return $this->fetchAndMap(
            $this->endpointUrl,
            static function (object $rate): MonobankData {
                return new MonobankData(
                    $rate->currencyCodeA,
                    $rate->currencyCodeB,
                    $rate->date,
                    $rate->rateSell ?? null,
                    $rate->rateBuy ?? null,
                    $rate->rateCross ?? null,
                );
            }
        );
    }
}
