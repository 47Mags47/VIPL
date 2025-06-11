<?php

namespace App\Jobs\File;

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

        $this->file->update(['status_id' => FileStatus::byCode('read')->id]);

        try {
            $this->file->update(['status_id' => FileStatus::byCode('loading')->id]);

            Excel::import(new RecipientImport($this->file), $this->file->localPath(), $this->file->disk, \Maatwebsite\Excel\Excel::CSV);

            $this->file->update(['status_id' => FileStatus::byCode('load')->id]);
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
