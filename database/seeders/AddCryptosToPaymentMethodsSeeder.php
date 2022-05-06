<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class AddCryptosToPaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'type' => 'BTC',
            'description' => 'Bitcoin',
            'active' => 1
        ]);

        PaymentMethod::create([
            'type' => 'ETH',
            'description' => 'Ethereum',
            'active' => 1
        ]);

        PaymentMethod::create([
            'type' => 'BUSD',
            'description' => 'Binance USD',
            'active' => 1
        ]);

        PaymentMethod::create([
            'type' => 'USDT',
            'description' => 'Tether',
            'active' => 1
        ]);

        PaymentMethod::create([
            'type' => 'DAI',
            'description' => 'Dai Stablecoin',
            'active' => 1
        ]);
    }
}
