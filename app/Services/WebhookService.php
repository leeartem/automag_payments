<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Vendors\SberHandler;

class WebhookService
{
    private const VENDORS = [
        '900' => 'sber',
        '+79275241157' => 'sber',
    ];

    public function run(array $payload): void
    {
        $handler = match (self::VENDORS[$payload['sender']]) {
            'sber' => app(SberHandler::class),
            default => null
        };

        if (null === $handler) {
            abort(404);
        }

        try {
            $handler->run($payload['message']);
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
//            throw $exception;
            abort(404);
        }
    }
}
