<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'generation_input' => 'shave a head',
                'slug' => 'shave-a-head',
                'category_id' => 1,
            ],
            [
                'generation_input' => 'fly a plane',
                'slug' => 'fly-a-plane',
                'category_id' => 2,
            ],
            [
                'generation_input' => 'study for exam',
                'slug' => 'study-for-exam',
                'category_id' => 3,
            ],
        ]);
    }
}
