<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_translations')->insert([
            [
                'page_id' => 1,
                'lang_id' => 1,
                'title' => 'bald title',
                'introduction' => 'intro',
                'conclusion' => 'conc',
            ],
            [
                'page_id' => 1,
                'lang_id' => 2,
                'title' => 'bald title in FRENCH',
                'introduction' => 'intro in FRENCH',
                'conclusion' => 'conc in FRENCH',
            ],
            [
                'page_id' => 1,
                'lang_id' => 3,
                'title' => 'bald title in SPANISH',
                'introduction' => 'intro in SPANISH',
                'conclusion' => 'conc in SPANISH',
            ],
        ]);
    }
}
