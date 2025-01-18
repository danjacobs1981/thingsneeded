<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_translations')->insert([
            [
                'section_id' => 1,
                'lang_id' => 1,
                'title' => 'section title',
            ],
            [
                'section_id' => 1,
                'lang_id' => 2,
                'title' => 'section title FRENCH',
            ],
            [
                'section_id' => 1,
                'lang_id' => 3,
                'title' => 'section title SPANISH',
            ],
        ]);
    }
}
