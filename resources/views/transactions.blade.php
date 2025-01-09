<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Платежи') }}
        </h2>
    </x-slot>
    @if(auth()->user()->isAdmin())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-col gap-5">
            <div class="block w-full bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4 mb-5">
                <livewire:transaction-check-form></livewire:transaction-check-form>
            </div>
            <div class="block w-full bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                <h1 class="mb-5 text-2xl font-semibold">
                    Список последних транзакций
                </h1>



                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Сумма
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Карточка
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Имя
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Время
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-left">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->amount }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $transaction->vendor }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->created_at->translatedFormat('d F Y, H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    @endif
</x-app-layout>
