<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessImagePage implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

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
            PageImager($id, true);
            sleep(2);
        }

    }
}
