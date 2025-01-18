<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Config;

class CategoryController extends Controller
{
    public function show(String $slug)
    {

        $category = Category::where('slug', $slug)->withTranslation()->first(); // have to do it the long way due to withTranslation?

        if (!$category) return abort(404);

        $pages = $category->pagesTranslation()->where('live', true)->get();

        if (!$pages) return abort(404);

        // set head items
        Config::set('constants.head.title', 'Find things needed in the category of '.$category->category);
        Config::set('constants.head.meta_title', 'Find things needed in the category of '.$category->category);
        Config::set('constants.head.meta_description', 'Find things needed in the category of '.$category->category.'.');
        Config::set('constants.head.link_canonical', config('constants.website.url_full').'/en/category/'.$category->slug.'/');
        // may need to improve the "hreflang" loop in head

        return view('layout.website.page.category', [
            'category' => $category,
            'pages' => $pages,
        ]);

    }

}
