<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Vendors\SberHandler;
use App\Services\Vendors\TinkoffHandler;

class WebhookService
{
    private const VENDORS = [
        'com.idamob.tinkoff.android' => 'tinkoff',
        'ru.sberbankmobile' => 'sber',
    ];

    public function run(array $payload): void
    {
        $handler = match (self::VENDORS[$payload['packageName']]) {
            'sber' => app(SberHandler::class),
            'tinkoff' => app(TinkoffHandler::class),
            default => null
        };

        if (null === $handler) {
//            abort(404);
        }

        try {
            $handler->run($payload['message'], $payload['sender']);
        } catch (\Throwable $exception) {
            throw $exception;
//            abort(404);
        }
    }
}
