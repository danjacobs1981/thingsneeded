<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tips')->insert([
            [
                'page_id' => 1,
                'position' => 1,
            ],
            [
                'page_id' => 1,
                'position' => 2,
            ],
            [
                'page_id' => 1,
                'position' => 3,
            ],
        ]);
    }
}
