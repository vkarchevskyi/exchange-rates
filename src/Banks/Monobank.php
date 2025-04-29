<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Banks;

use Alcohol\ISO4217;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use JsonException;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Interfaces\BankInterface;
use Vkarchevskyi\ExchangeRates\Repositories\MonobankRepository;
use Vkarchevskyi\ExchangeRates\Resources\API\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Resources\ExchangeRateResource;

final readonly class Monobank implements BankInterface
{
    private const UKRAINIAN_HRIVNIA_CODE = 980;

    public function __construct(private MonobankRepository $repository, private ISO4217 $iso4217)
    {
    }

    /**
     * @inheritDoc
     * @throws ConnectionException
     * @throws ApiException
     * @throws JsonException
     */
    public function rates(array $currencies): array
    {
        return (new Collection($this->repository->getData()))
            ->filter(
                fn (MonobankApiResource $rate): bool => isset($rate->rateSell)
                    && isset($rate->rateBuy)
                    && $rate->currencyCodeB === self::UKRAINIAN_HRIVNIA_CODE
                    && in_array(
                        $this->getCurrencyFromCode($rate->currencyCodeA),
                        $currencies,
                        true
                    )
            )
            ->map(
                fn (MonobankApiResource $rate): ExchangeRateResource => new ExchangeRateResource(
                    $this->getCurrencyFromCode($rate->currencyCodeA),
                    $this->getCurrencyFromCode($rate->currencyCodeB),
                    (float)$rate->rateBuy,
                    (float)$rate->rateSell
                )
            )
            ->all();
    }

    private function getCurrencyFromCode(int $code): string
    {
        return $this->iso4217->getByCode((string)$code)['alpha3'];
    }
}
