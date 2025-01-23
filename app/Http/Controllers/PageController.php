<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Type;
use App\Models\Step;

use Config;

class PageController extends Controller
{
    public function show(String $slug)
    {

        $page = Page::where('live', true)->where('slug', $slug)->withTranslation()->first(); // have to do it the long way due to withTranslation?

        if (!$page) return abort(404);

        $types = Type::withTranslation()->get(); // collection

        //dd($types);

        $things = $page->things()->where('live', true)->get(); // collection

        //dd($things);

        $tips = $page->tips()->where('live', true)->get(); // collection

        //dd($things);

        $sections = $page->sections()->where('live', true)->get(); // collection
        $steps = Step::where('live', true)->whereIn('section_id', $sections->modelKeys())->withTranslation()->get(); // steps from sections using 'modelKeys()' collection

        //dd($steps);

        $tags = $page->tags()->get(); // collection

        $relatedIDs = $page->relatedPagesByTag()->where('live', true)->inRandomOrder()->take(3)->pluck('id')->toArray(); // array
        $related = Page::whereIn('page_id', $relatedIDs)->withTranslation()->get(); // collection

        //dd($related);

        // set head items
        Config::set('constants.head.title', $page->title);
        Config::set('constants.head.meta_title', $page->title);
        Config::set('constants.head.meta_description', $page->conclusion);
        Config::set('constants.head.meta_keywords', $tags->pluck('tag')->implode(',')); // comma sep
        Config::set('constants.head.link_canonical', config('constants.website.url_full').'/en/'.$page->slug.'/');

        return view('layout.website.page.page', [
            'page' => $page,
            'types' => $types,
            'things' => $things,
            'tips' => $tips,
            'sections' => $sections,
            'steps' => $steps,
            'tags' => $tags,
            'related' => $related,
        ]);

    }

}
