<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessGeneratePage implements ShouldQueue
{
    use Queueable;

    public $topic;
    public $prompt;
    public $page_id;

    /**
     * Create a new job instance.
     */
    public function __construct($topic, $prompt, $page_id)
    {

        $this->topic = $topic;
        $this->prompt = $prompt;
        $this->page_id = $page_id;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $ignore_topic = false;

        if ($this->page_id != null) { // it's an overwrite
            $ignore_topic = true;
        }

        $page_data = PageCreator($this->topic, $this->prompt, $ignore_topic); // gemini creates the page
        // if (!$page_data) return dd('fail');
        if ($page_data) {
            $page_id = PageInserter($page_data, 0, $this->page_id); // data, batch (0/1), page_id (if overwrite)
            CategoryTranslator(); // gemini translates any categories not translated yet
            TagTranslator(); // gemini translates any tags not translated yet
            PageTranslator($page_id); // gemini (re)translation of a page
        } else {
            // catch failure
        }

    }
}
