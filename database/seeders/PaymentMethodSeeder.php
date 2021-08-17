<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'type' => 'CREDIT_CARD',
            'description' => 'Tarjetas de Crédito',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'DEBIT_CARD',
            'description' => 'Tarjetas débito',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'PSE',
            'description' => 'Transferencias bancarias PSE',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'PAYPAL',
            'description' => 'Pago a través de cuenta PayPal',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'BANK_TRANSFER',
            'description' => 'Transferencias bancarias',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'CASH',
            'description' => 'Pago en efectivo',
            'status' => 1
        ]);

        PaymentMethod::create([
            'type' => 'ACH',
            'description' => 'Débitos ACH',
            'status' => 1
        ]);
    }
}
