<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('step_translations')->insert([
            [
                'step_id' => 1,
                'lang_id' => 1,
                'title' => 'step title',
                'subtext' => 'step subtext',
            ],
            [
                'step_id' => 1,
                'lang_id' => 2,
                'title' => 'step title FRENCH',
                'subtext' => 'step subtext FRENCH',
            ],
            [
                'step_id' => 1,
                'lang_id' => 3,
                'title' => 'step title SPANISH',
                'subtext' => 'step subtext SPANISH',
            ],
        ]);
    }
}
