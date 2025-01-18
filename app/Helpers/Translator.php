<?php

set_time_limit(0);

use App\Models\Language;
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

if (!function_exists('PageTranslator')) {

    function PageTranslator($page_id, $force = false) {

        try {
            $page = Page::where('id', $page_id)->first();
        } catch (Throwable $e) {
            dd('ddddddddddd: '.$e);
        }

        if (!$page) return dd('page not exist');

        if ($page->translated && !$force) return dd('page already translated');

        if ($page->editing) return dd('page in edit mode');

        // delete any existing translations
        PageTranslation::where('lang_id', '!=', 1)->where('page_id', $page_id)->delete();
        $things = Thing::where('page_id', $page_id)->pluck('id');
        ThingTranslation::where('lang_id', '!=', 1)->whereIn('thing_id', $things)->delete();
        $tips = Tip::where('page_id', $page_id)->pluck('id');
        TipTranslation::where('lang_id', '!=', 1)->whereIn('tip_id', $tips)->delete();
        $sections = Section::where('page_id', $page_id)->pluck('id');
        SectionTranslation::where('lang_id', '!=', 1)->whereIn('section_id', $sections)->delete();
        $steps = Step::whereIn('section_id', $sections)->pluck('id');
        StepTranslation::where('lang_id', '!=', 1)->whereIn('step_id', $steps)->delete();

        // set page translated to 0 (in case anything fails)
        $page->update(['translated' => 0]);

        // creates array to be translated
        $array_page = PageTranslation::select('title', 'introduction', 'conclusion')->where('lang_id', 1)->where('page_id', $page_id)->first()->toArray();
        $array_things = ThingTranslation::select('thing_id', 'title', 'subtext', 'search_phrase')->where('lang_id', 1)->whereIn('thing_id', $things)->get()->toArray();
        $array_tips = TipTranslation::select('tip_id', 'title', 'subtext')->where('lang_id', 1)->whereIn('tip_id', $tips)->get()->toArray();
        $array_sections = SectionTranslation::select('section_id', 'title')->where('lang_id', 1)->whereIn('section_id', $sections)->get()->toArray();
        $array_steps = StepTranslation::select('step_id', 'title', 'subtext')->where('lang_id', 1)->whereIn('step_id', $steps)->get()->toArray();

        $array = array(
            'page' => $array_page,
            'things' => $array_things,
            'tips' => $array_tips,
            'sections' => $array_sections,
            'steps' => $array_steps,
        );

        $translate = json_encode($array);

        $languages = Language::where('id', '!=', 1)->get();

        //$languages = array_chunk($languages, 3);

        //dd($languages);

        // translation and row insert for each language
        foreach($languages as $language) {
            $lang_id = $language->id;
            $translation = [];
            $translation = json_encode(Translator($translate, $lang_id));
            $translation = json_decode($translation, true);
            $translation['page']['lang_id'] = $lang_id;
            $translation['page']['page_id'] = $page_id;
            PageTranslation::create($translation['page']);
            foreach($translation['things'] as $thing) {
                $thing['lang_id'] = $lang_id;
                ThingTranslation::create($thing);
            }
            foreach($translation['tips'] as $tip) {
                $tip['lang_id'] = $lang_id;
                TipTranslation::create($tip);
            }
            foreach($translation['sections'] as $section) {
                $section['lang_id'] = $lang_id;
                SectionTranslation::create($section);
            }
            foreach($translation['steps'] as $step) {
                $step['lang_id'] = $lang_id;
                StepTranslation::create($step);
            }
            sleep(2);
        }

        // the V2 version did all translations at once... and suffered MAX_TOKENS output

        // $translations = TranslatorV2($translate);

        // foreach($translations as $translation) {
        //     $json = [];
        //     $lang_id = $languages->where('name', $translation->language)->pluck('id')->first();
        //     $json = json_decode($translation->translated_json, true);
        //     $json['page']['lang_id'] = $lang_id;
        //     $json['page']['page_id'] = $page_id;
        //     //dd($json['page']);
        //     PageTranslation::create($json['page']);
        //     foreach($json['things'] as $thing) {
        //         $thing['lang_id'] = $lang_id;
        //         ThingTranslation::create($thing);
        //     }
        //     foreach($json['tips'] as $tip) {
        //         $tip['lang_id'] = $lang_id;
        //         TipTranslation::create($tip);
        //     }
        //     foreach($json['sections'] as $section) {
        //         $section['lang_id'] = $lang_id;
        //         SectionTranslation::create($section);
        //     }
        //     foreach($json['steps'] as $step) {
        //         $step['lang_id'] = $lang_id;
        //         StepTranslation::create($step);
        //     }
        // }

        // set page translated to 1 (now complete)
        $page->update(['translated' => 1]);

    }

}

if (!function_exists('CategoryTranslator')) {

    function CategoryTranslator($regenerate = false) {

        // delete any unused categories
        Category::has('pages', '=', 0)->delete();

        if ($regenerate) {
            CategoryTranslation::where('lang_id', '!=', 1)->delete();
        }

        $languages = Language::where('id', '!=', 1)->get();

        foreach($languages as $language) {
            $en = [];
            $new = [];
            $ids = [];
            $translate = [];
            $translation = [];
            Category::get();
            $en = CategoryTranslation::where('lang_id', 1)->pluck('category_id')->toArray();
            $new = CategoryTranslation::where('lang_id', $language->id)->pluck('category_id')->toArray();
            $ids = array_diff($en, $new);
            if ($ids) {
                $translate = CategoryTranslation::select('category_id', 'category')->where('lang_id', 1)->whereIn('category_id', $ids)->get()->toArray();
                $translation = Translator(json_encode($translate), $language->id);
                // if($language->id == 5) {
                //     dd($translation);
                // }
                foreach ($translation as $key => $row){
                    $category = new CategoryTranslation();
                    $category->lang_id = $language->id;
                    $category->category_id = $row->category_id;
                    $category->category = $row->category;
                    $category->save();
                }
            }
        }

    }

}

if (!function_exists('TagTranslator')) {

    function TagTranslator($regenerate = false) {

        // delete any unused tags
        Tag::has('pages', '=', 0)->delete();

        if ($regenerate) {
            TagTranslation::where('lang_id', '!=', 1)->delete();
        }

        $languages = Language::where('id', '!=', 1)->get();

        foreach($languages as $language) {
            $en = [];
            $new = [];
            $ids = [];
            $translate = [];
            $translation = [];
            Tag::get();
            $en = TagTranslation::where('lang_id', 1)->pluck('tag_id')->toArray();
            $new = TagTranslation::where('lang_id', $language->id)->pluck('tag_id')->toArray();
            $ids = array_diff($en, $new);
            if ($ids) {
                $translate = TagTranslation::select('tag_id', 'tag')->where('lang_id', 1)->whereIn('tag_id', $ids)->get()->toArray();
                $translation = Translator(json_encode($translate), $language->id);
                foreach ($translation as $key => $row){
                    $tag = new TagTranslation();
                    $tag->lang_id = $language->id;
                    $tag->tag_id = $row->tag_id;
                    $tag->tag = $row->tag;
                    $tag->save();
                }
            }
        }

    }

}
