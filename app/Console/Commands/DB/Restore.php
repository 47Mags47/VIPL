<?php

namespace App\Console\Commands\DB;

use App\Classes\Dumper;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Restore extends Command
{
    protected $signature = 'db:restore {--last} {--data} {--path=}';
    protected $description = 'Восстанавление БД из бэкапа';

    public function handle()
    {
        $backups = collect(Storage::disk('backups')->allFiles($this->option('data') ? 'data' : 'full'))
            ->sortBy(
                fn($backup) => Storage::disk('backups')->lastModified($backup)
            )
            ->slice(0, 10)
            ->toArray();

        $path = $this->option('path');

        if ($this->option('last')) {
            $path = Storage::disk('backups')->path($backups[0]);
        }

        if ($path === null) {
            $backup = $this->choice('Выбор дампа', array_reverse($backups), 0);
            $path = Storage::disk('backups')->path($backup);
        }

        if (!file_exists($path)) {
            Log::error("Файл $path не существует");
            throw new Exception("Попытка восстановить БД из несуществующего файла: " . $path);
        }

        new Dumper()->restore($path);

        $this->info('Восстановление дампа БД Завершено');
    }
}
