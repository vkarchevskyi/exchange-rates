<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Vkarchevskyi\ExchangeRates\Data\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Factories\SerializerFactory;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository
{
    public function __construct(
        private FetchService $fetch,
        private SerializerFactory $factory,
    ) {
    }

    /**
     * @return MonobankApiResource[]
     * @throws ConnectionException
     * @throws ApiException
     */
    public function getData(): array
    {
        /** @var MonobankApiResource[] $data */
        $data = $this->factory->build()->deserialize(
            $this->fetch->run(Config::string('exchange-rates.banks.monobank.endpoint')),
            MonobankApiResource::class . '[]',
            'json'
        );

        return $data;
    }
}
