<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CountriesSeeder::class,
            PaymentGatewaySeeder::class,
            PaymentMethodSeeder::class,
            DocumentTypesSeeder::class,
            GivingTypesSeeder::class
        ]);
    }
}
