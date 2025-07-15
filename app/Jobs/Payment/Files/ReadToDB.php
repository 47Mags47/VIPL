<?php

namespace App\Jobs\Payment\Files;

use App\Imports\Payment\RecipientImport;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ReadToDB implements ShouldQueue
{
    use Queueable;

    public function __construct(public File $file) {}

    public function handle(): void
    {
        if (!$this->file->checkThisCSV()) {
            $this->file->addError('Файл не является csv');
            return;
        }

        $this->file->setStatus('read');
        try {
            $this->file->setStatus('loading');
            Excel::import(new RecipientImport($this->file), $this->file->localPath(), $this->file->disk, \Maatwebsite\Excel\Excel::CSV);
            $this->file->setStatus('load');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                foreach ($failure->errors() as $error) {
                    $this->file->addError($error, $failure->values());
                }
            }
        }
    }
}
