<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Админ',
            'email' => 'automag_kam@mail.ru',
            'password' => config('app.admin_password'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Автомаг Базарова',
            'email' => 'bazarova@automagkam.ru',
            'password' => config('app.user_password'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Автомаг Партсъезда',
            'email' => 'partsezd@automagkam.ru',
            'password' => config('app.user_password'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Автомаг Некрасова',
            'email' => 'nekrasova@automagkam.ru',
            'password' => config('app.user_password'),
            'role_id' => 2,
        ]);
    }
}
