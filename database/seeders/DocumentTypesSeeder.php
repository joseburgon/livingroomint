<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::create([
            'code' => 'CC',
            'name' => 'CÉDULA DE CIUDADANÍA',
        ]);

        DocumentType::create([
            'code' => 'CE',
            'name' => 'CÉDULA DE EXTRANJERÍA',
        ]);

        DocumentType::create([
            'code' => 'NIT',
            'name' => 'NIT',
        ]);

        DocumentType::create([
            'code' => 'PP',
            'name' => 'PASAPORTE',
        ]);

        DocumentType::create([
            'code' => 'TI',
            'name' => 'TARJETA DE IDENTIDAD',
        ]);

        DocumentType::create([
            'code' => 'DE',
            'name' => 'DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO',
        ]);
    }
}
