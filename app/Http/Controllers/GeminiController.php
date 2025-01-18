<?php

namespace App\Http\Controllers;

class GeminiController extends Controller
{
    public function show()
    {


        // PageTranslator(121);
        // CategoryTranslator();
        // TagTranslator();
        //dd('done');

        $ideas = IdeaGenerator(1, ''); // amount & further prompt

        foreach($ideas->ideas as $input_topic) {
            $page_data = PageCreator($input_topic->idea, null);
            if (!$page_data) return dd('fail');
            $page_id = PageInserter($page_data);
            sleep(15);
            PageTranslator($page_id);
            sleep(15);
        }
        CategoryTranslator();
        TagTranslator();

        dd('done 1 pages');

        $input_topic = 'long weekend in Prague';
        $page_data = PageCreator($input_topic, null); // gemini creates the page
        if (!$page_data) return dd('fail');
        $page_id = PageInserter($page_data);

        CategoryTranslator(); // gemini translates any categories not translated yet
        // CategoryTranslator(true); // gemini (re)translation of all categories

        TagTranslator(); // gemini translates any tags not translated yet
        // TagTranslator(true); // gemini (re)translation of all tags

        PageTranslator($page_id, false); // gemini (re)translation of a page, set 'true' to force translation

        dd('complete');

        //return response(view('gemini',array('result'=>$result)),200, ['Content-Type' => 'application/json']); // prints out json - needs: {!! json_encode($result) !!} (inside blade file)

    }
}
