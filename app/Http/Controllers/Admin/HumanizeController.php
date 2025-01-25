<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessHumanizePage;

use App\Models\Page;
use App\Models\PageTranslation; // TEMP


class HumanizeController extends Controller
{

    public function page() {

        return view('layout.admin.page.humanize-page');

    }

    public function progress() {

    }

    public function start(Request $request) {

        if (!$request->id) return dd('no id(s) entered');

        $ids = array_map( 'intval', array_filter( explode(',', $request->id), 'is_numeric' ) );

        foreach ($ids as $id) {
            ProcessHumanizePage::dispatch($id, count($ids))->onQueue('humanizations');
        }

        return count($ids).' pages will be humanized. Run - queue:work --queue=humanizations or queue:work --queue=pages,humanizations,translations,images';


    }

}
