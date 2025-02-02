<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageTranslation;


class PageController extends Controller
{

    public function show(String $slug) {

        $page = Page::where('slug', $slug)->withTranslation()->first();

        if (!$page) return 'page doesn\'t exist!';

        return view('layout.admin.page.edit-page', [
            'page' => $page,
        ]);

    }

    public function save(String $slug, Request $request) {

        $page = Page::where('slug', $slug)->first();

        if (!$page) return 'page doesn\'t exist!';

        Page::where('id', $page->id)->update(['edited' => 1]);
        PageTranslation::where('page_id', $page->id)->update(['introduction' => $request->introduction, 'conclusion' => $request->conclusion]);

        return to_route('pages');

    }

    public function humanize(String $slug, Request $request) {

        $page = Page::where('slug', $slug)->first();

        if (!$page) return 'page doesn\'t exist!';

        return response()->json(array(
            'intro' => $request->all()
        ));

        // Page::where('id', $page->id)->update(['edited' => 1]);
        // PageTranslation::where('page_id', $page->id)->update(['introduction' => $request->introduction, 'conclusion' => $request->conclusion]);

        // return to_route('pages');

    }

}
