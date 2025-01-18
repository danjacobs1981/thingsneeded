<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessImagePage;

use App\Models\Page;


class ImageController extends Controller
{

    public function page() {

        return view('layout.admin.page.image-page');

    }

    public function progress() {

    }

    public function start(Request $request) {

        if (!$request->id) return dd('no id(s) entered');

        $ids = array_map( 'intval', array_filter( explode(',', $request->id), 'is_numeric' ) );

        $pages = Page::whereIn('id', $ids)->count();

        if($pages !== count($ids)){
            return dd('not all ids exist');
        }

        ProcessImagePage::dispatch($ids);

        return 'Images(s) will be created.';

    }

}
