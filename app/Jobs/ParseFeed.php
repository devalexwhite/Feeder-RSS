<?php

namespace App\Jobs;

use App\Models\Feed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ParseFeed implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Feed $feed)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Parse the feed
        $this->feed->parseFeed();
    }
}
