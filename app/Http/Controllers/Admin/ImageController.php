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

        if (!$request->id) return 'No ID(s) entered!';

        $ids = array_map( 'intval', array_filter( explode(',', $request->id), 'is_numeric' ) );

        if (config('app.env') === 'local') {

            return 'Image creation should only happen on live site.';

        } else {

            foreach ($ids as $id) {
                ProcessImagePage::dispatch($id, count($ids))->onQueue('images');
            }

            return count($ids).' images will be created. Run - queue:work --queue=images or queue:work --queue=pages,translations,images';

        }

    }

}
