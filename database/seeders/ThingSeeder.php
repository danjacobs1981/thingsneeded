<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('things')->insert([
            [
                'page_id' => 1,
                'type_id' => 1,
                'purchasable' => 1,
                'position' => 1,
            ],
            [
                'page_id' => 1,
                'type_id' => 1,
                'purchasable' => 1,
                'position' => 2,
            ],
            [
                'page_id' => 1,
                'type_id' => 1,
                'purchasable' => 1,
                'position' => 3,
            ],
        ]);
    }
}
