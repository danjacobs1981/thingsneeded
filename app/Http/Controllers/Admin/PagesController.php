<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessTranslatePage;
use App\Jobs\ProcessImagePage;
use App\Jobs\ProcessGeneratePage;

use App\Models\Page;


class PagesController extends Controller
{

    public function show(Request $request) {

        $pageModel = new Page;

        $allPages = $pageModel->pages()->get();

        if (isset($request->live)) {
            $pages = $pageModel->pages()->where('live', 1)->get();
        } else if (isset($request->notlive)) {
            $pages = $pageModel->pages()->where('live', null)->get();
        } else if (isset($request->translated)) {
            $pages = $pageModel->pages()->where('translated', 1)->get();
        } else if (isset($request->nottranslated)) {
            $pages = $pageModel->pages()->where('translated', 0)->get();
        } else if (isset($request->image)) {
            $pages = $pageModel->pages()->where('image', 1)->get();
        } else if (isset($request->noimage)) {
            $pages = $pageModel->pages()->where('image', 0)->get();
        } else if (isset($request->products)) {
            $pages = $pageModel->pages()->where('products', 1)->get();
        } else if (isset($request->noproducts)) {
            $pages = $pageModel->pages()->where('products', 0)->get();
        } else if (isset($request->edited)) {
            $pages = $pageModel->pages()->where('edited', 1)->get();
        } else if (isset($request->notedited)) {
            $pages = $pageModel->pages()->where('edited', 0)->get();
        } else if (isset($request->editmode)) {
            $pages = $pageModel->pages()->where('editmode', 1)->get();
        } else if (isset($request->noteditmode)) {
            $pages = $pageModel->pages()->where('editmode', 0)->get();
        } else {
            $pages = $pageModel->pages()->get();
        }

        // comma sep list of no images
        // $pages = $pageModel->pages()->where('image', 0)->pluck('id');
        // dd($pages->implode(','));

        //dd($pages);

        return view('layout.admin.page.pages', [
            'allPages' => $allPages,
            'pages' => $pages,
        ]);

    }

    public function save(Request $request) {

        if ($request->action === "live") {
            Page::whereIn('id', $request->ids)->update(['live' => 1]);
        }

        if ($request->action === "offline") {
            Page::whereIn('id', $request->ids)->update(['live' => 0]);
        }

        if ($request->action === "translate") {
            foreach ($request->ids as $id) {
                ProcessTranslatePage::dispatch($id, count($request->ids))->onQueue('translations');
            }
        }

        if ($request->action === "image") {
            foreach ($request->ids as $id) {
                ProcessImagePage::dispatch($id, count($request->ids))->onQueue('images');
            }
        }

        if ($request->action === "regenerate") {
            foreach ($request->ids as $id) {
                $prompt = null;
                $topic = Page::where('id', $id)->pluck('input_topic')->first();
                ProcessGeneratePage::dispatch($topic, $prompt, $id, 0)->onQueue('pages'); // topic, further prompt, existing id, batch
            }
        }

        return to_route('pages');

    }

}
