<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessHumanizePage;

use App\Models\Page;
//use App\Models\PageTranslation;


class HumanizeController extends Controller
{

    public function page() {


        // $pages = Page::pluck('id');
        // foreach($pages as $page_id) {
        //     $introduction = PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('introduction');
        //     $conclusion = PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('conclusion');
        //     PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->update(['org_introduction' => $introduction, 'org_conclusion' => $conclusion]);
        // }

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
