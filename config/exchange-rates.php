<?php

declare(strict_types=1);

return [
    'banks' => [
        'monobank' => [
            'endpoint' => 'https://api.monobank.ua/bank/currency',
        ],

        'privatbank' => [
            'endpoint' => 'https://api.privatbank.ua/p24api/exchange_rates',
        ],
    ],

    'default_pairs' => [
        ['USD', 'UAH'],
        ['EUR', 'UAH'],
    ],
];
