<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Date;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use Vkarchevskyi\ExchangeRates\Data\PrivatbankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

final readonly class PrivatbankRepository implements BankRepositoryInterface
{
    public function __construct(
        private FetchService $fetch,
        #[Config('exchange-rates.banks.privatbank.endpoint')]
        private string $endpoint,
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @return PrivatbankApiResource[]
     * @throws ConnectionException
     * @throws Throwable
     * @throws ApiException
     */
    public function getRates(): array
    {
        $endpoint = sprintf('%s?date=%s', $this->endpoint, Date::now()->format('d.m.Y'));

        return $this->serializer->deserialize(
            $this->fetch->run($endpoint),
            PrivatbankApiResource::class,
            'json'
        );
    }
}
