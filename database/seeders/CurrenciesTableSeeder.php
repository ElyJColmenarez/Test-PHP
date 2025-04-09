<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder {
    public function run() {
        $currencies = [
            [
                'name' => 'Dólar Estadounidense',
                'symbol' => 'USD',
                'exchange_rate' => 1.0000, // Moneda base
            ],
            [
                'name' => 'Peso Argentino',
                'symbol' => 'ARS',
                'exchange_rate' => 0.0012, // Ejemplo: 1 ARS = 0.0012 USD
            ],
            [
                'name' => 'Euro',
                'symbol' => 'EUR',
                'exchange_rate' => 1.0800, // 1 EUR = 1.08 USD
            ],
            [
                'name' => 'Dólar Canadiense',
                'symbol' => 'CAD',
                'exchange_rate' => 0.7300, // 1 CAD = 0.73 USD
            ],
            [
                'name' => 'Peso Dominicano',
                'symbol' => 'DOP',
                'exchange_rate' => 0.017, // 1 DOP = 0.017 USD
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
