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
                    return 'Page does not exist.';
                }
            } else if (!$request->topic) {
                return 'A topic must be entered.';
            }

            ProcessGeneratePage::dispatch($request->topic, $request->prompt, $existing_id, 0); // topic, further prompt, existing id, batch

            return 'Page will be created.';

        } else if($request->type == "batch") {

            $amount = 10;

            if($request->amount) {
                $amount = $request->amount;
            }

            $ideas_data = IdeaGenerator($amount, $request->prompt); // gemini generates some ideas

            if ($ideas_data) {

                foreach($ideas_data->ideas as $input_topic) {

                    ProcessGeneratePage::dispatch($input_topic->idea, null, false, 1); // topic, further prompt, existing id, batch
                }

            } else {

                return 'Error: Gemini failed to return ideas!';

            }

            return 'A batch of '.$amount.' page(s) will be created.';

        }

    }

}
