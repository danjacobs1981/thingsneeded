<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

use Config;

class SearchController extends Controller
{
    public function show()
    {

        // set head items
        Config::set('constants.head.title', 'Search '.config('app.name'));
        Config::set('constants.head.meta_title', 'Search '.config('app.name'));
        Config::set('constants.head.link_canonical', config('constants.website.url_full').'/en/search');

        if (request()->has('q') && request()->filled('q')) {

            $pageModel = new Page;
            $pages = Page::where('live', true)
                ->whereAny(['title', 'introduction', 'conclusion'], 'like', '%'.request()->get('q', '').'%')
                ->withTranslation()
                ->get();

            return view('layout.website.page.search', [
                'pages' => $pages,
            ]);

        } else {

            return view('layout.website.page.search');

        }

    }

}
