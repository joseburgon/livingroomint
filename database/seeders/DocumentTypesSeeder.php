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
            'name' => 'Cédula de Ciudadanía',
        ]);

        DocumentType::create([
            'code' => 'CE',
            'name' => 'Cédula de Extranjería',
        ]);

        DocumentType::create([
            'code' => 'NIT',
            'name' => 'NIT',
        ]);

        DocumentType::create([
            'code' => 'PP',
            'name' => 'Pasaporte',
        ]);

        DocumentType::create([
            'code' => 'TI',
            'name' => 'Tarjeta de Identidad',
        ]);

        DocumentType::create([
            'code' => 'DE',
            'name' => 'Documento de Identificación Extranjero',
        ]);
    }
}
