<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tip_translations')->insert([
            [
                'tip_id' => 1,
                'lang_id' => 1,
                'title' => 'tip title',
                'subtext' => 'tip subtext',
            ],
            [
                'tip_id' => 1,
                'lang_id' => 2,
                'title' => 'tip title FRENCH',
                'subtext' => 'tip subtext FRENCH',
            ],
            [
                'tip_id' => 1,
                'lang_id' => 3,
                'title' => 'tip title SPANISH',
                'subtext' => 'tip subtext SPANISH',
            ],
        ]);
    }
}
