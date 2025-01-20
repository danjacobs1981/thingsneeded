<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Support\Facades\Log;

class ProcessGeneratePage implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

    public $topic;
    public $prompt;
    public $page_id;
    public $batch;

    /**
     * Create a new job instance.
     */
    public function __construct($topic, $prompt, $page_id, $batch)
    {

        $this->topic = $topic;
        $this->prompt = $prompt;
        $this->page_id = $page_id;
        $this->batch = $batch;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $overwrite = false;

        if ($this->page_id != null) { // it's an overwrite
            $overwrite = true;
        }

        $page_data = PageCreator($this->topic, $this->prompt, $overwrite); // gemini creates the page (3 attempts)

        if ($page_data) {

            $page_id = PageInserter($page_data, $this->batch, $this->page_id); // data, batch, page_id (if overwrite)
            CategoryTranslator(false); // gemini translates any categories not translated yet
            sleep(2);
            TagTranslator(false); // gemini translates any tags not translated yet
            sleep(2);
            PageTranslator($page_id, true); // gemini translation of a page - forced because there is new content, it needs translating
            sleep(10);
            PageImager($page_id, false); // image creation for page - not forced, because if it's a page overwrite, still keep the image (if it exists)
            if ($this->batch) {
                sleep(10);
            }

        } else {

            if ($this->page_id) {
                Log::channel('generate')->error('Gemini failure (when overwriting Page ID '.$this->page_id.')!');
                throw new \Exception('Page Creation Error: Gemini failure (when overwriting Page ID '.$this->page_id.')!');
            } else {
                Log::channel('generate')->error('Gemini failure (when creating new page)!');
                throw new \Exception('Page Creation Error: Gemini failure!');
            }

        }

    }
}
