<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessHumanizePage implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

    public $page_id;
    public $amount;

    /**
     * Create a new job instance.
     */
    public function __construct($page_id, $amount)
    {

        $this->page_id = $page_id;
        $this->amount = $amount;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $success = PageHumanizer($this->page_id, true); // page id, force overwrite
        if($success) { // only translate if humanizing happened and it overwrote main
            PageTranslator($page_id, true); // gemini translation of a page - forced because there is new content, it needs translating
        }
        if ($this->amount > 1) {
            sleep(5);
        }

    }
}
