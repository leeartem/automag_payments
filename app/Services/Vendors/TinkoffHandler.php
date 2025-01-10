<?php

declare(strict_types=1);

namespace App\Services\Vendors;


use App\Models\Transaction;
use Illuminate\Support\Str;

class TinkoffHandler extends AbstractHandler
{
    public const VENDOR = 'tinkoff';

    public function run(string $message): void
    {
        $message = str_replace("\u{A0}", " ", $message);
        $this->validate($message);
        $data = [
            ...$this->parse($message),
            'sms'    => $message,
            'uuid'   => Str::uuid(),
            'vendor' => self::VENDOR,
        ];

        Transaction::query()->create($data);
    }

    protected function validate(string $message): void
    {
        if (
            !str_contains($message, 'Пополнение на')
        ) {
            throw new \Exception('Wrong message');
        }
    }

    protected function parse(string $message): array
    {
        $pattern = '/Пополнение на (\d+(?:,\d+)?) ₽.*? ([А-ЯЁ][а-яё]+\s[А-ЯЁ]\.)/u';
//        dd($message);

        if (preg_match($pattern, $message, $matches)) {
            $amount = str_replace(',', '.', $matches[1]);
            $name = $matches[2];

            return [
                'amount' => $amount,
                'name'   => $name,
            ];
        } else {
            throw new \Exception('Parsing failed');
        }
    }
}
