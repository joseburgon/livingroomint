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
            'status' => 1
        ]);

        PaymentGateway::create([
            'name' => 'PayPal',
            'status' => 1
        ]);

        PaymentGateway::create([
            'name' => 'Wompi',
            'status' => 0
        ]);

        PaymentGateway::create([
            'name' => 'MercadoPago',
            'status' => 0
        ]);
    }
}
