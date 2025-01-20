<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessGenerateBatch implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

    public $amount;
    public $prompt;

    /**
     * Create a new job instance.
     */
    public function __construct($amount, $prompt)
    {

        $this->amount = $amount;
        $this->prompt = $prompt;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $ideas = IdeaGenerator($this->amount, $this->prompt); // amount & further prompt

        foreach($ideas->ideas as $input_topic) {
            $page_data = PageCreator($input_topic->idea, null);
            // if (!$page_data) return dd('fail');
            $page_id = PageInserter($page_data, 1, null); // 1 means batch
            sleep(15);
            PageTranslator($page_id);
            sleep(15);
        }
        CategoryTranslator();
        TagTranslator();

        // foreach($ideas->ideas as $idea) {
        //     ProcessCreatePages::dispatch($ideas);
        // }


    }
}
