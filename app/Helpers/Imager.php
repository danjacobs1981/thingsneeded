<?php

set_time_limit(0);

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\Page;


if (!function_exists('PageImager')) {

    function PageImager($page_id, $force = false) {

        try {

            $page = Page::findOrFail($page_id);

        } catch (\Exception $e) {

            throw new \Exception('Image Creation Error: Page ID '.$page_id.' - does not exist!');

        }

        if ($page->image && !$force) {

            return;
            // log instead?
            // throw new \Exception('Image Creation: Page ID '.$page_id.' - image already exists (force = false)!');

        }

        $page->update(['image' => 0]);

        $prompt = "Create a photo with the topic: '".$page->input_topic."'. The photo must NOT include any humans, including any human body parts, like hands. NO hands. The photo must NOT include any words, numbers or text of any kind.";

        $options = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $rand = rand(99999, 999999999);
        $image_jpg = @file_get_contents('https://image.pollinations.ai/prompt/'.urlencode($prompt).'?width=800&height=382&seed='.$rand.'&enhance=true&nologo=true&model=flux&negative=humans,people,characters,hands,text,words', false, stream_context_create($options));

        if ($image_jpg === FALSE) {

            throw new \Exception('Image Creation Error: Page ID '.$page_id.' - image generation failure!');

        } else {

            $path = 'images/hero/'.$page->slug;
            Storage::disk('public')->put($path.'.jpg', $image_jpg);

            $original_jpg = Storage::disk('public')->path($path.'.jpg');

            $manager = new ImageManager(Driver::class);
            $original_image = $manager->read($original_jpg);

            $image_webp = clone $original_image;
            $image_jpg_card = clone $original_image;
            $image_webp_card = clone $original_image;


            $image_webp = $image_webp->toWebp(75);
            Storage::disk('public')->put($path.'.webp', $image_webp);

            $path_card = 'images/card/'.$page->slug;

            $image_jpg_card = $image_jpg_card->cover(380, 176)->toJpg(75);
            Storage::disk('public')->put($path_card.'.jpg', $image_jpg_card);

            $image_webp_card = $image_webp_card->cover(380, 176)->toWebp(75);
            Storage::disk('public')->put($path_card.'.webp', $image_webp_card);

            // set page image to 1 (now complete)
            $page->update(['image' => 1]);

        }

    }

}
