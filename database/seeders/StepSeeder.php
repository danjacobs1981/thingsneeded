<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('steps')->insert([
            [
                'section_id' => 1,
                'position' => 1,
            ],
            [
                'section_id' => 1,
                'position' => 2,
            ],
            [
                'section_id' => 1,
                'position' => 3,
            ],
        ]);
    }
}
