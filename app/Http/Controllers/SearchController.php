<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class SearchController extends Controller
{
    public function show()
    {

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
