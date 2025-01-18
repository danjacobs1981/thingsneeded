<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('affiliates')->insert([
            [
                'name' => 'Amazon UK',
                'locale' => 'uk',
                'currency' => 'GBP',
                'tld' => '.co.uk',
                'tag' => 'danjacocrea-21',
            ],
            [
                'name' => 'Amazon US',
                'locale' => 'us',
                'currency' => 'USD',
                'tld' => '.com',
                'tag' => 'danUS',
            ],
            [
                'name' => 'Amazon France',
                'locale' => 'fr',
                'currency' => 'EUR',
                'tld' => '.fr',
                'tag' => 'danFRANCE',
            ],
        ]);
    }
}
