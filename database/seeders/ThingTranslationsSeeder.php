<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThingTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thing_translations')->insert([
            [
                'thing_id' => 1,
                'lang_id' => 1,
                'title' => 'my first thing',
                'subtext' => 'my first thing subtext',
                'search_phrase' => 'phrase used to search',
            ],
            [
                'thing_id' => 1,
                'lang_id' => 2,
                'title' => 'my first thing FRENCH',
                'subtext' => 'my first thing subtext FRENCH',
                'search_phrase' => 'phrase used to search FRENCH',
            ],
            [
                'thing_id' => 1,
                'lang_id' => 3,
                'title' => 'my first thing SPANISH',
                'subtext' => 'my first thing subtext SPANISH',
                'search_phrase' => 'phrase used to search SPANISH',
            ],
        ]);
    }
}
