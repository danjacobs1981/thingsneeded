<?php

namespace App\Http\Controllers;

use App\Models\Page;

use Config;

class HomeController extends Controller
{
    public function show()
    {

        $pageModel = new Page;
        $pages = Page::where('live', true)
            ->latest()
            ->withTranslation()
            ->take(9)
            ->get();

        // set head items
        Config::set('constants.head.title', 'Welcome to '.config('app.name'));
        Config::set('constants.head.meta_title', 'Welcome to '.config('app.name'));
        Config::set('constants.head.link_canonical', config('constants.website.url_full').'/en');

        return view('layout.website.page.home', [
            'pages' => $pages,
        ]);

    }

}
