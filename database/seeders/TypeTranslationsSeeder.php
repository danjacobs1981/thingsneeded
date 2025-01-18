<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_translations')->insert([
            [
                'type_id' => 1,
                'lang_id' => 1,
                'type' => 'Legal',
                'title' => 'Legal things required',
            ],
            [
                'type_id' => 1,
                'lang_id' => 2,
                'type' => 'Légal',
                'title' => 'Documents légaux requis',
            ],
            [
                'type_id' => 1,
                'lang_id' => 3,
                'type' => 'Legal',
                'title' => 'Requisitos legales',
            ],
            [
                'type_id' => 2,
                'lang_id' => 1,
                'type' => 'Essential',
                'title' => 'Essential things needed',
            ],
            [
                'type_id' => 2,
                'lang_id' => 2,
                'type' => 'Essentiel',
                'title' => 'Objets essentiels',
            ],
            [
                'type_id' => 2,
                'lang_id' => 3,
                'type' => 'Esenciales',
                'title' => 'Cosas esenciales necesarias',
            ],
            [
                'type_id' => 3,
                'lang_id' => 1,
                'type' => 'Optional',
                'title' => 'Extra optional items',
            ],
            [
                'type_id' => 3,
                'lang_id' => 2,
                'type' => 'Optionnel',
                'title' => 'Objets supplémentaires facultatifs',
            ],
            [
                'type_id' => 3,
                'lang_id' => 3,
                'type' => 'Opcional',
                'title' => 'Artículos opcionales',
            ],
        ]);
    }
}
