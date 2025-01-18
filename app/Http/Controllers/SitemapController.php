<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

use App\Models\Page;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Language;


class SitemapController extends Controller
{

    public function show()
    {

        $general = [ // add any general pages here
            [
                'slug' => '',
                'translated' => 1,
            ],
            [
                'slug' => 'search',
                'translated' => 1,
            ],
            [
                'slug' => 'privacy',
                'translated' => 1,
            ]
        ];

        $pages = Page::where('live', true)->get();
        $categories = Category::get();
        $tags = Tag::get();
        $languages = Language::get();

        $xml = view('sitemap', compact('general', 'pages', 'categories', 'tags', 'languages'))->render();

        return response(trim($xml))->withHeaders([ // 'trim' is there to make sure no extra spaces - else xml would fail
            'content-type' => 'text/xml'
         ]);

    }

}
