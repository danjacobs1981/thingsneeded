<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;


class PagesController extends Controller
{

    public function show(Request $request) {

        //dd($request->h);

        $pageModel = new Page;
        $pages = $pageModel->pages()->get();

        //dd($pages);

        return view('layout.admin.page.pages', [
            'pages' => $pages,
        ]);

    }

}
