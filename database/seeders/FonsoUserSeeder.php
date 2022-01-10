<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FonsoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Alfonso Valega',
            'email' => 'amvalega@outlook.com',
            'password' => 'Safe*2022'
        ]);
    }
}
