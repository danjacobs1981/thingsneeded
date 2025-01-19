<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessGenerateBatch;
use App\Jobs\ProcessGeneratePage;

use App\Models\Page;


class GenerateController extends Controller
{

    public function page() {

        return view('layout.admin.page.generate-page');

    }

    public function batch() {

        return view('layout.admin.page.generate-batch');

    }

    public function progress() {

    }

    public function start(Request $request) {

        if($request->type == "page") {

            $existing_id = null;

            if ($request->page_id) {
                $existing_id = $request->page_id;
                $request->prompt = null;
                $request->topic = Page::where('id', $existing_id)->pluck('input_topic')->first();
                if (!$request->topic) {
                    dd('page not exist');
                }
            } else if (!$request->topic) {
                dd('no topic fail');
            }

            ProcessGeneratePage::dispatch($request->topic, $request->prompt, $existing_id);

            return 'Page will be created.';

        } else if($request->type == "batch") {

            $amount = 10;

            if($request->amount) {
                $amount = $request->amount;
            }

            ProcessGenerateBatch::dispatch($amount, $request->prompt);

            return 'Page(s) will be created.';

        }

    }

}
