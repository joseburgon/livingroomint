<?php

namespace Database\Seeders;

use App\Models\GivingType;
use Illuminate\Database\Seeder;

class GivingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GivingType::create([
            'name' => 'Advance Messengers',
            'active' => false,
        ]);

        GivingType::create([
            'name' => 'Alive',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Camp',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Campus Barranquilla',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Campus Bucaramanga',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Campus Medellín',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Campus Valencia (Venezuela)',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Campus Cali',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'College',
            'active' => true,
        ]);

        GivingType::create([
            'name' => 'Connection Messenger',
            'active' => false,
        ]);

        GivingType::create([
            'name' => 'Empowerment',
            'active' => false,
        ]);

        GivingType::create([
            'name' => 'Life Coach',
            'active' => false,
        ]);

        GivingType::create([
            'name' => 'Live Concert',
            'active' => false,
        ]);

        GivingType::create([
            'name' => 'Messengers',
            'active' => false,
        ]);
    }
}
