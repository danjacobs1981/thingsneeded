<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessTranslatePage;

use App\Models\Page;


class TranslateController extends Controller
{

    public function page() {

        return view('layout.admin.page.translate-page');

    }

    public function progress() {

    }

    public function start(Request $request) {

        if (!$request->id) return dd('no id(s) entered');

        $ids = array_map( 'intval', array_filter( explode(',', $request->id), 'is_numeric' ) );

        foreach ($ids as $id) {
            ProcessTranslatePage::dispatch($id, count($ids));
        }

        return count($ids).' pages will be translated.';


    }

}
