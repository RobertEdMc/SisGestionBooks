<?php

namespace App\Jobs;

use App\Models\Autor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatedTotalLibsJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autorId;

    /**
     * Create a new job instance.
     */
    public function __construct($autorId)
    {
        $this->autorId = $autorId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $autor = Autor::find($this->autorId);

        if ($autor) {
            $autor->total_books = $autor->libs()->count();
            $autor->save();
        }
    }
}
