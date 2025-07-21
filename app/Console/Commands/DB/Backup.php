<?php

namespace App\Console\Commands\DB;

use App\Classes\Dumper;
use Illuminate\Console\Command;

class Backup extends Command
{
    protected $signature = 'db:backup {--data}';

    protected $description = 'Полное сохранение БД';

    public function handle()
    {
        // FULL
        new Dumper()
            ->setPath($this->option('data') ? 'data' : 'full')
            ->setName(now()->format('dmYHis_') . "backup.sql")
            ->onlyData($this->option('data') ?? false)
            ->start();

        $this->info('Создание дампа данных БД завершено');
    }
}
