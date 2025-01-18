<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use Config;

class TagController extends Controller
{
    public function show(String $slug)
    {

        $tag = Tag::where('slug', $slug)->withTranslation()->first(); // have to do it the long way due to withTranslation?

        if (!$tag) return abort(404);

        $pages = $tag->pagesTranslation()->where('live', true)->get();

        //dd($pages);

        if (!$pages) return abort(404);

        // set head items
        Config::set('constants.head.title', 'Find things needed featuring: '.$tag->tag);
        Config::set('constants.head.meta_title', 'Find things needed featuring: '.$tag->tag);
        Config::set('constants.head.meta_description', 'Find things needed featuring: '.$tag->tag.'.');
        Config::set('constants.head.link_canonical', config('constants.website.url_full').'/en/tag/'.$tag->slug.'/');
        // may need to improve the "hreflang" loop in head

        return view('layout.website.page.tag', [
            'tag' => $tag,
            'pages' => $pages,
        ]);

    }

}
