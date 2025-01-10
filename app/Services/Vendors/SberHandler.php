<?php

declare(strict_types=1);

namespace App\Services\Vendors;


use App\Models\Transaction;
use Illuminate\Support\Str;

class SberHandler extends AbstractHandler
{
    public const VENDOR = 'sber';

    public function run(string $message, ?string $title = null): void
    {
        $this->validate($title);
        $data = [
            ...$this->parse($title, $message),
            'sms' => $message,
            'uuid' => Str::uuid(),
            'vendor' => self::VENDOR,
        ];

        Transaction::query()->create($data);
    }

    protected function validate(string $title): void
    {
        if (
            !str_contains($title, 'Перевод от')
        ) {
            throw new \Exception('Wrong message');
        }
    }

    protected function parse(string $title, string $message): array
    {
        $result = [];

        preg_match('/от ([^.]+)\./u', $message, $matches);
        $result['name'] = str_replace("Игорь У.: Перевод от ", "", $title) ?? null;

        if (preg_match('/^([\w\s\p{Pd}]+)\s\+\s([\d,\.]+)\s?₽/u', $message, $matches)) {
            $result['bank'] = $matches[1];
            $result['amount'] = (float) str_replace(',', '.', $matches[2]);
        }

        return $result;
    }
}
