<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class ExchangeRatesProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/exchange-rates.php', 'exchange-rates');
    }
}
