<?php

set_time_limit(0);

use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\GenerationConfig;
use Gemini\Data\Schema;
use Gemini\Enums\ResponseMimeType;
use Gemini\Enums\DataType;

use App\Models\Page;
use App\Models\Language;


if (!function_exists('IdeaGenerator')) {

    function IdeaGenerator($amount = 20, $prompt = null) {

        $input_topics = Page::pluck('input_topic')->toJson();

        //dd($input_topics);

        $generationConfig = new GenerationConfig(
            responseMimeType: ResponseMimeType::APPLICATION_JSON,
            responseSchema: new Schema (
                type: DataType::OBJECT,
                properties: [
                    "ideas" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "idea" => new Schema(type: DataType::STRING),
                            ],
                            required: ["idea"]
                        )
                    ),

                ],
                required: ["ideas"]
            )
        );

        $attempts = 0;

        do {

            try {
                $result = Gemini::generativeModel(model: 'gemini-2.0-flash-exp')
                    ->withGenerationConfig($generationConfig)
                    ->generateContent("

                        I am building a 'things needed' website that has pages that list items you need to complete a certain task or do a certain thing.

                        ".$prompt."

                        Please provide exactly ".$amount." suggestions/topic page ideas that I can use in the website. But do NOT suggest anything similar to the following list of ideas:

                        ".$input_topics."

                    ")->json();

                return $result;

            } catch (Exception $e) {
                // If an error occurs, return an error message
                // echo json_encode(['error' => $e->getMessage()]);
                $attempts++;
                dd('ideas: '.$e);
                sleep(5);
                continue;
            }

            break;

        } while($attempts < 3);

    }

}

if (!function_exists('Translator')) {

    function Translator($json, $lang_id) {

        $language = Language::where('id', $lang_id)->first();

        $generationConfig = new GenerationConfig(
            responseMimeType: ResponseMimeType::APPLICATION_JSON
        );

        $attempts = 0;

        do {

            try {

                $result = Gemini::generativeModel(model: 'gemini-2.0-flash-exp')
                    ->withGenerationConfig($generationConfig)
                    ->generateContent("

                        Convert all the values of this JSON into ".$language->name.". The translation should be formal and natural. However, do not translate any of the key names. Also, do not translate any integer values.

                        ".$json."

                    ")
                    ->json();

                return $result;

            } catch (Exception $e) {
                // If an error occurs, return an error message
                // echo json_encode(['error' => $e->getMessage()]);
                $attempts++;
                dd('transV1: '.$e);
                sleep(5);
                continue;
            }

            break;

        } while($attempts < 3);

    }

}

if (!function_exists('TranslatorV2')) { // not using as MAX_TOKENS

    function TranslatorV2($json) {

        $languages = Language::where('id', '!=', 1)->pluck('name')->toJson();

        $generationConfig = new GenerationConfig(
            responseMimeType: ResponseMimeType::APPLICATION_JSON,
            responseSchema: new Schema (
                type: DataType::ARRAY,
                items: new Schema (
                    type: DataType::OBJECT,
                    properties: [
                        "language" => new Schema(type: DataType::STRING),
                        "translated_json" => new Schema(type: DataType::STRING),
                    ],
                    required: ["language", "translated_json"]
                )
            )
        );

        $attempts = 0;

        do {

            try {

                $result = Gemini::generativeModel(model: 'gemini-2.0-flash-exp')
                    ->withGenerationConfig($generationConfig)
                    ->generateContent("

                        I need some JSON translated into these languages: ".$languages.". Do not translate any of the key names. Also, do not translate any integer values.

                        The 'translations' should have an object for each 'language' and include its 'translated_json'.

                        Here is the JSON to be translated:

                        ".$json."

                    ")
                    ->json();

                    //dd($result);

                return $result;

            } catch (Exception $e) {
                // If an error occurs, return an error message
                // echo json_encode(['error' => $e->getMessage()]);
                $attempts++;
                dd('transV2: '.$e);
                sleep(5);
                continue;
            }

            break;

        } while($attempts < 3);

    }

}

if (!function_exists('ImageCreator')) {

    function ImageCreator($input_topic) {



    }

}

if (!function_exists('PageCreator')) {

    function PageCreator($input_topic, $input_prompt = null, $ignore_topic = false) {

        if (!$ignore_topic) {
            $topic_exists = Page::where('input_topic', $input_topic)->exists();
            if ($topic_exists) return null; // do something here!
        }

        $generationConfig = new GenerationConfig(
            responseMimeType: ResponseMimeType::APPLICATION_JSON,
            responseSchema: new Schema (
                type: DataType::OBJECT,
                properties: [
                    "title" => new Schema(type: DataType::STRING),
                    "introduction" => new Schema(type: DataType::STRING),
                    //"sentiment" => new Schema(type: DataType::STRING, enum: ["POSITIVE", "NEGATIVE", "NEUTRAL"]),
                    "legal_items" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "item" => new Schema(type: DataType::STRING),
                                "subtext" => new Schema(type: DataType::STRING),
                                "purchasable" => new Schema(type: DataType::BOOLEAN),
                                "search_phrase" => new Schema(type: DataType::STRING),
                            ],
                            required: ["item", "subtext"]
                        )
                    ),
                    "essential_items" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "item" => new Schema(type: DataType::STRING),
                                "subtext" => new Schema(type: DataType::STRING),
                                "purchasable" => new Schema(type: DataType::BOOLEAN),
                                "search_phrase" => new Schema(type: DataType::STRING),
                            ],
                            required: ["item", "subtext"]
                        )
                    ),
                    "optional_items" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "item" => new Schema(type: DataType::STRING),
                                "subtext" => new Schema(type: DataType::STRING),
                                "purchasable" => new Schema(type: DataType::BOOLEAN),
                                "search_phrase" => new Schema(type: DataType::STRING),
                            ],
                            required: ["item", "subtext"]
                        )
                    ),
                    // "xxxxx_items" => new Schema ( // if adding new item/thing type be sure to add row in types table in DB
                    //     type: DataType::ARRAY,
                    //     items: new Schema (
                    //         type: DataType::OBJECT,
                    //         properties: [
                    //             "item" => new Schema(type: DataType::STRING),
                    //             "subtext" => new Schema(type: DataType::STRING),
                    //             "purchasable" => new Schema(type: DataType::BOOLEAN),
                    //             "search_phrase" => new Schema(type: DataType::STRING),
                    //         ],
                    //         required: ["item", "subtext"]
                    //     )
                    // ),
                    "additional_tips" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "item" => new Schema(type: DataType::STRING),
                                "subtext" => new Schema(type: DataType::STRING),
                            ],
                            required: ["item", "subtext"]
                        )
                    ),
                    "steps" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema (
                            type: DataType::OBJECT,
                            properties: [
                                "section_title" => new Schema(type: DataType::STRING),
                                "items" => new Schema (
                                    type: DataType::ARRAY,
                                    items: new Schema (
                                        type: DataType::OBJECT,
                                        properties: [
                                            "optional" => new Schema(type: DataType::BOOLEAN),
                                            "step" => new Schema(type: DataType::STRING),
                                            "subtext" => new Schema(type: DataType::STRING),
                                        ],
                                        required: ["step", "subtext"]
                                    )
                                ),
                            ],
                            required: ["section_title"]
                        )
                    ),
                    "category" => new Schema(type: DataType::STRING),
                    "tags" => new Schema (
                        type: DataType::ARRAY,
                        items: new Schema(type: DataType::STRING)
                    ),
                    "conclusion" => new Schema(type: DataType::STRING),
                    "reading_time" => new Schema(type: DataType::INTEGER),
                ],
                required: ["title", "introduction", "essential_items", "category", "tags", "conclusion", "reading_time"]
            )
        );

        // https://www.amazon.co.uk/s?s=exact-aware-popularity-rank&k=Paint when Building a model airplane

        $attempts = 0;

        do {

            try {

                $result = Gemini::generativeModel(model: 'gemini-2.0-flash-exp')
                    ->withGenerationConfig($generationConfig)
                    ->generateContent("

                        The topic is: '".$input_topic."'.

                        Create a title for the page, along the lines of 'Things Needed for/to/when *topic*'. Capitalize all significant words of the title.

                        ".$input_prompt."

                        Create an introduction to the page in a concise, naturally written, single paragraph.

                        Please generate a list of all the things I would need for the above topic.

                        Each list item should be unique.

                        List any legal items if necessary. Each item should have some subtext to summarize its requirement. If you can buy this kind of item on Amazon then set 'purchasable' to 'true'. If you were to search for this product, think up a suitable search phrase bearing in mind the topic.

                        List all essential items. Each item should have some subtext to summarize its requirement. If you can buy this kind of item on Amazon then set 'purchasable' to 'true'. If you were to search for this product, think up a suitable search phrase bearing in mind the topic.

                        List any optional items. Each item should have some subtext to summarize its requirement. If you can buy this kind of item on Amazon then set 'purchasable' to 'true'. If you were to search for this product, think up a suitable search phrase bearing in mind the topic.

                        List any additional tips. Each item should have some subtext to summarize the tip.

                        Then, only if applicable, add a step-by-step guide to complete the task based on the information you've provided so far. There must be at least 2 sections that contain numerous steps in each. Do not add numbers to steps.

                        Create a suitable category. This should be a fairly common, well known, standard, category.

                        Add between 3 - 10 simple but relevant tags that cover all aspects of the topic (they must be relevant!). Tags to be lowercase unless it's an initialism.

                        Write a paragraph or two as a conclusion.

                        In minutes, specify the estimated time it would take to read the page that's been created.

                        Always punctuate the end of the sentence of any subtext.

                    ")
                    ->json();

                $result->input_topic = $input_topic;
                $result->input_prompt = $input_prompt;
                $result->gemini_model = 'gemini-2.0-flash-exp';

                return $result;

            } catch (Exception $e) {
                // If an error occurs, return an error message
                // echo json_encode(['error' => $e->getMessage()]);
                $attempts++;
                dd('creator: '.$e);
                sleep(5);
                continue;
            }

            break;

        } while($attempts < 3);

    }

}
