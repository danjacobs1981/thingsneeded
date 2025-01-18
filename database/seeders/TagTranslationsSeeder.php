<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tag_translations')->insert([
            [
                'tag_id' => 1,
                'lang_id' => 1,
                'tag' => 'tag',
            ],
            [
                'tag_id' => 1,
                'lang_id' => 2,
                'tag' => 'tag FRENCH',
            ],
            [
                'tag_id' => 1,
                'lang_id' => 3,
                'tag' => 'tag SPANISH',
            ],
        ]);
    }
}
