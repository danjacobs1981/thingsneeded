<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_translations')->insert([
            [
                'category_id' => 1,
                'lang_id' => 1,
                'category' => 'my category',
            ],
            [
                'category_id' => 1,
                'lang_id' => 2,
                'category' => 'my category FRENCH',
            ],
            [
                'category_id' => 1,
                'lang_id' => 3,
                'category' => 'my category SPANISH',
            ],
        ]);
    }
}
