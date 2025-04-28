<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data;

use Vkarchevskyi\ExchangeRates\Data\Privatbank\PrivatbankApiRateResource;

final class PrivatbankApiResource
{
    private string $date;
    private string $bank;
    private string $baseCurrency;
    private string $baseCurrencyLit;
    /**
     * @var PrivatbankApiRateResource[]
     */
    private array $exchangeRate;

    /**
     * @return PrivatbankApiRateResource[]
     */
    public function getExchangeRate(): array
    {
        return $this->exchangeRate;
    }

    /**
     * @param PrivatbankApiRateResource[] $exchangeRate
     */
    public function setExchangeRate(array $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getBaseCurrencyLit(): string
    {
        return $this->baseCurrencyLit;
    }

    public function setBaseCurrencyLit(string $baseCurrencyLit): void
    {
        $this->baseCurrencyLit = $baseCurrencyLit;
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function setBaseCurrency(string $baseCurrency): void
    {
        $this->baseCurrency = $baseCurrency;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function setBank(string $bank): void
    {
        $this->bank = $bank;
    }
}
