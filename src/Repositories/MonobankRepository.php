<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use Vkarchevskyi\ExchangeRates\Data\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository implements BankRepositoryInterface
{
    public function __construct(
        private FetchService $fetch,
        #[Config('exchange-rates.banks.monobank.endpoint')]
        private string $endpoint,
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @return MonobankApiResource[]
     * @throws ConnectionException
     * @throws Throwable
     * @throws ApiException
     */
    public function getRates(): array
    {
        return $this->serializer->deserialize(
            $this->fetch->run($this->endpoint),
            MonobankApiResource::class . '[]',
            'json'
        );
    }
}
