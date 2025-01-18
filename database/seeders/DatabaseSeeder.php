<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LanguageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AffiliateSeeder::class);
        $this->call(ThingSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(TipSeeder::class);
        $this->call(CategoryTranslationsSeeder::class);
        $this->call(PageTranslationsSeeder::class);
        $this->call(ThingTranslationsSeeder::class);
        $this->call(SectionTranslationsSeeder::class);
        $this->call(StepTranslationsSeeder::class);
        $this->call(TipTranslationsSeeder::class);
        $this->call(TagTranslationsSeeder::class);
    }
}
