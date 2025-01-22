<?php

namespace App\Http\Controllers;

use App\Models\Page;

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

        return view('layout.website.page.home', [
            'pages' => $pages,
        ]);

    }

}
