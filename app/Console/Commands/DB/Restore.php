<?php

namespace App\Console\Commands\DB;

use App\Classes\Dumper;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Restore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Восстанавление БД из бэкапа';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('path') !== null)
            $path = $this->option('path');
        else {
            $backups = array_slice(Storage::disk('backups')->allFiles(), -20);
            $path = Storage::disk('backups')->path($this->choice('Выбор дампа', array_reverse($backups), 0));
        }

        if (!file_exists($path)) {
            Log::error("Файл $path не существует");
            throw new Exception("Попытка восстановить БД из несуществующего файла: " . $path);
        }

        new Dumper()->restore($path);

        $this->info('Восстановление дампа БД Завершено');
    }
}
