<?php

set_time_limit(0);

use Illuminate\Support\Facades\Log;

use App\Models\Page;
use App\Models\PageTranslation;

if (!function_exists('PageHumanizer')) {

    function PageHumanizer($page_id, $force = false) {

        try {

            $page = Page::findOrFail($page_id);

        } catch (\Exception $e) {

            Log::channel('generate')->error('PageHumanizer: Page ID '.$page_id.' - does not exist!');
            throw new \Exception('PageHumanizer: Page ID '.$page_id.' - does not exist!');
            return false;

        }

        if ($page->humanized && !$force) {

            Log::channel('generate')->warning('PageHumanizer: Page ID '.$page_id.' - page already humanized (force = false)!');
            return false;

        }

        Log::channel('generate')->info('PageHumanizer: Page ID '.$page_id.' - starting humanizing!');

        // set page humanized to 0 (in case anything fails)
        $page->update(['humanized' => 0]);

        $introduction = Humanizer(PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('introduction_gemini'));
        sleep(2);
        $conclusion = Humanizer(PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->value('conclusion_gemini'));

        if($introduction && $conclusion) {

            // if($page->edited) {

                PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->update(['introduction_humanized' => $introduction, 'conclusion_humanized' => $conclusion]);
                Log::channel('generate')->warning('PageHumanizer: Page ID '.$page_id.' - finished humanizing but didn\'t overwriting existing intro & conclusion!');

                // set page humanized to 1 (now complete)
                $page->update(['humanized' => 1]);

                return false;

            // } else {

            //     PageTranslation::where('lang_id', 1)->where('page_id', $page_id)->update(['introduction' => $introduction, 'conclusion' => $conclusion, 'introduction_humanized' => $introduction, 'conclusion_humanized' => $conclusion]);
            //     Log::channel('generate')->info('PageHumanizer: Page ID '.$page_id.' - finished humanizing and made this version the main intro & conclusion!');

            //     // set page humanized to 1 (now complete)
            //     $page->update(['humanized' => 1]);

            //     return true; // it will translate now

            // }

        } else {

            Log::channel('generate')->error('PageHumanizer: Page ID '.$page_id.' - failed humanizing!');
            return false;

        }

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
            return false;

        } else {

            return $response;

        }

    }

}
