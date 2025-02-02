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
    public $introduction;
    public $conclusion;

    /**
     * Create a new job instance.
     */
    public function __construct($page_id, $amount, $introduction, $conclusion)
    {

        $this->page_id = $page_id;
        $this->amount = $amount;
        $this->introduction = $introduction;
        $this->conclusion = $conclusion;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        PageHumanizer($this->page_id, $this->introduction, $this->conclusion); // page id, force overwrite
        if ($this->amount > 1) {
            sleep(5);
        }

    }
}
