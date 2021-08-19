<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentGateway::create([
            'name' => 'PayU Latam',
            'active' => 1
        ]);

        PaymentGateway::create([
            'name' => 'PayPal',
            'active' => 1
        ]);

        PaymentGateway::create([
            'name' => 'Wompi',
            'active' => 0
        ]);

        PaymentGateway::create([
            'name' => 'MercadoPago',
            'active' => 0
        ]);
    }
}
