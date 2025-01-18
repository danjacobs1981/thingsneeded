<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function setlanguage(Request $request)
    {
        //\Session::put('language', $request->locale);
        //app()->setLocale($request->locale);

        session()->put('locale', $request->locale);
        //return redirect()->back();

        //dd(app()->currentLocale());

        return back();
    }

}
