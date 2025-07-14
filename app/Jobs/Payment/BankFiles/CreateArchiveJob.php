<?php

namespace App\Jobs\Payment\BankFiles;

use App\Models\Payment\Raport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class CreateArchiveJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Raport $raport) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $zip = new ZipArchive();
        $file_name = '.zip';
        $path = Storage::disk('archive')->path($file_name);

    }
}
