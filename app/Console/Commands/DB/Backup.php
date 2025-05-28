<?php

namespace App\Console\Commands\DB;

use App\Classes\Dumper;
use Illuminate\Console\Command;

class Backup extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Полное сохранение БД';

    public function handle()
    {
        // FULL
        $this->info('Создание полного дампа БД');

        $dumper = new Dumper();
        $dumper
            ->setPath(storage_path('app/private/backup/full'))
            ->setName(now()->format('dmYHis_') . "backup.sql");
        $dump_path = $dumper->start();

        $this->info('Создание полного дампа БД завершено');
        $this->info('Дамп сохранен в '. $dump_path);

        // DATA
        $this->info('Создание дампа данных БД');

        $dumper = new Dumper();
        $dumper
            ->setPath(storage_path('app/private/backup/data'))
            ->setName(now()->format('dmYHis_') . "backup.sql")
            ->onlyData(true);
        $dump_path = $dumper->start();

        $this->info('Создание дампа данных БД завершено');
        $this->info('Дамп сохранен в '. $dump_path);
    }
}
