<?php

set_time_limit(0);

use Illuminate\Support\Facades\Log;

use App\Models\Page;
use App\Models\PageTranslation;

if (!function_exists('PageHumanizer')) {

    function PageHumanizer($page_id, $introduction = true, $conclusion = true) {

        try {

            $page = Page::findOrFail($page_id);

        } catch (\Exception $e) {

            Log::channel('generate')->error('PageHumanizer: Page ID '.$page_id.' - does not exist!');
            throw new \Exception('PageHumanizer: Page ID '.$page_id.' - does not exist!');

        }

        Log::channel('generate')->info('PageHumanizer: Page ID '.$page_id.' - starting humanizing!');

        if ($introduction) {

            $introduction = Humanizer(PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('introduction_gemini'));
            PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->update(['introduction_humanized' => $introduction]);

        }

        if ($conclusion) {

            $conclusion = Humanizer(PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('conclusion_gemini'));
            PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->update(['conclusion_humanized' => $conclusion]);

        }

        Log::channel('generate')->info('PageHumanizer: Page ID '.$page_id.' - finished humanizing!');

    }

}

if (!function_exists('Humanizer')) {

    function Humanizer($input) {

        $email = 'danjacobs@gmail.com'; // TODO: enter AI-Text-Humanizer.com account email here
        $password = '33AR!ZBvpyNqMRH'; // TODO: enter AI-Text-Humanizer.com account password here
        $text = $input; // TODO: place your input text here.

        $ch = curl_init( 'https://ai-text-humanizer.com/api.php' );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'email=' . urlencode($email) . '&pw=' . urlencode($password) . '&text=' . urlencode($text));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {

            Log::channel('generate')->error('PageHumanizer: Page ID '.$page_id.' - '.$err);

        } else {

            return $response;

        }

    }

}
