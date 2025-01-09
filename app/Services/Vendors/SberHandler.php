<?php

declare(strict_types=1);

namespace App\Services\Vendors;


use App\Models\Transaction;
use Illuminate\Support\Str;

class SberHandler extends AbstractHandler
{
    public function run(string $message): void
    {
        $this->validate($message);
        $data = [
            ...$this->parse($message),
            'sms' => $message,
            'uuid' => Str::uuid(),
        ];

        Transaction::query()->create($data);
    }

    protected function validate(string $message): void
    {
        if (
            !str_contains($message, 'Перевод из')
        ) {
            abort(404);
        }
    }

    protected function parse(string $message): array
    {
        $result = [];

        preg_match('/\b(\w+-\d+)\b/', $message, $matches);
        $result['card'] = $matches[1] ?? null;

        preg_match('/из ([\wА-Яа-я\s]+)/u', $message, $matches);
        $result['bank'] = trim($matches[1] ?? '');

        preg_match('/\+([\d.]+)р от/', $message, $matches);
        $result['amount'] = isset($matches[1]) ? (float)$matches[1] : null;

        preg_match('/от ([^.]+)\./u', $message, $matches);
        $result['name'] = $matches[1] ?? null;

        return $result;
    }
}
