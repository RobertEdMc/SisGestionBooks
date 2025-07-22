<?php

namespace App\Jobs;

use App\Models\Author;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatedTotalLibsJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $authorId;

    /**
     * Create a new job instance.
     */
    public function __construct($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $author = Author::find($this->authorId);

        if ($author) {
            $author->total_books = $author->libs()->count();
            $author->save();
        }
    }
}
