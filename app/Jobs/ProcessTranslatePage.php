<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTranslatePage implements ShouldQueue
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

        PageTranslator($this->page_id, true); // page id, force overwrite
        if ($this->amount > 1) {
            sleep(10);
        }

    }
}
