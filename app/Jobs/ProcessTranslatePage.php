<?php

namespace App\Jobs;

set_time_limit(0);

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTranslatePage implements ShouldQueue
{
    use Queueable;

    public $page_ids;

    /**
     * Create a new job instance.
     */
    public function __construct($page_ids)
    {

        $this->page_ids = $page_ids;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach ($this->page_ids as $id) {
            PageTranslator($id, true);
            sleep(2);
        }

    }
}
