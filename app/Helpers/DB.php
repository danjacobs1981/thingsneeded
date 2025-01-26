<?php

set_time_limit(0);

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

use App\Models\Author;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Type;
use App\Models\Thing;
use App\Models\ThingTranslation;
use App\Models\Tip;
use App\Models\TipTranslation;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Section;
use App\Models\SectionTranslation;
use App\Models\Step;
use App\Models\StepTranslation;

if (!function_exists('PageInserter')) {

    function PageInserter($result, $batch = 0, $existing_id = null) {

        // author
        $author_id = Author::inRandomOrder()->take(1)->pluck('id')->first();

        // category
        $category_insert = Category::firstOrCreate(['slug' => Str::slug($result->category, "-")]);
        CategoryTranslation::firstOrCreate(['category_id' => $category_insert->id, 'lang_id' => 1, 'category' => $result->category]);

        // page
        if ($existing_id == null) {
            $page_insert = Page::create(['input_topic' => $result->input_topic, 'input_prompt' => $result->input_prompt, 'slug' => Str::slug($result->title, "-"), 'category_id' => $category_insert->id, 'author_id' => $author_id, 'reading_time' => $result->reading_time, 'batch' => $batch, 'gemini_model' => $result->gemini_model]);
            $page_id = $page_insert->id;
            PageTranslation::create(['page_id' => $page_id, 'lang_id' => 1, 'title' => $result->title, 'introduction' => $result->introduction, 'conclusion' => $result->conclusion, 'introduction_gemini' => $result->introduction, 'introduction_gemini' => $result->conclusion]);
            Log::channel('generate')->info('PageInserter: Page ID '.$page_id.' - a new page will be created!');
        } else {
            $existing_slug = Page::where('id', $existing_id)->pluck('slug')->first();
            $existing_image = Page::where('id', $existing_id)->pluck('image')->first();
            Page::where('id', $existing_id)->delete();
            $page_insert = Page::create(['id' => $existing_id, 'input_topic' => $result->input_topic, 'input_prompt' => $result->input_prompt, 'slug' => $existing_slug, 'category_id' => $category_insert->id, 'author_id' => $author_id, 'image' => $existing_image, 'reading_time' => $result->reading_time, 'batch' => $batch, 'gemini_model' => $result->gemini_model]);
            $page_id = $page_insert->id;
            PageTranslation::create(['page_id' => $page_id, 'lang_id' => 1, 'title' => $result->title, 'introduction' => $result->introduction, 'conclusion' => $result->conclusion, 'introduction_gemini' => $result->introduction, 'introduction_gemini' => $result->conclusion]);
            Log::channel('generate')->info('PageInserter: Page ID '.$page_id.' - existing page will be overwritten (topic & image kept)!');
        }

        // thing types
        $types = Type::get();
        foreach($types as $type) {
            $id = $type->identifier;
            $position = 1;
            if (isset($result->$id)) {
                foreach($result->$id as $thing) {
                    $thing_insert = Thing::create(['page_id' => $page_id, 'type_id' => $type->id, 'purchasable' => $thing->purchasable ?? 0, 'position' => $position]);
                    ThingTranslation::create(['thing_id' => $thing_insert->id, 'lang_id' => 1, 'title' => $thing->item, 'subtext' => $thing->subtext, 'search_phrase' => $thing->search_phrase ?? null]);
                    $position++;
                }
            }
        }

        // tips
        if (isset($result->additional_tips)) {
            $position = 1;
            foreach($result->additional_tips as $tip) {
                $tip_insert = Tip::create(['page_id' => $page_id, 'position' => $position]);
                TipTranslation::create(['tip_id' => $tip_insert->id, 'lang_id' => 1, 'title' => $tip->item, 'subtext' => $tip->subtext]);
                $position++;
            }
        }

        // steps
        if (isset($result->steps)) {
            $position = 1;
            foreach($result->steps as $section) {
                $section_insert = Section::create(['page_id' => $page_id, 'position' => $position]);
                SectionTranslation::create(['section_id' => $section_insert->id, 'lang_id' => 1, 'title' => $section->section_title]);
                $position++;
                $position_step = 1;
                foreach($section->items as $step) {
                    $step_insert = Step::create(['section_id' => $section_insert->id, 'optional' => $step->optional ?? 0, 'position' => $position_step]);
                    StepTranslation::create(['step_id' => $step_insert->id, 'lang_id' => 1, 'title' => $step->step, 'subtext' => $step->subtext]);
                    $position_step++;
                }
            }
        }

        // tags
        if (isset($result->tags)) {
            foreach($result->tags as $tag) {
                Tag::get();
                $tag_exists = Tag::where('slug', Str::slug($tag, "-"))->first();
                $pageModel = new Page;
                if (!$tag_exists) {
                    $tag_insert = Tag::create(['slug' => Str::slug($tag, "-")]);
                    TagTranslation::create(['tag_id' => $tag_insert->id, 'lang_id' => 1, 'tag' => $tag]);
                    $pageModel->tags()->attach($tag_insert->id, ['page_id' => $page_id]);
                } else {
                    $pageModel->tags()->attach($tag_exists->id, ['page_id' => $page_id]);
                }
            }
        }

        Log::channel('generate')->info('PageInserter: Page ID '.$page_id.' - initial data added!');

        return $page_id;

    }

}
