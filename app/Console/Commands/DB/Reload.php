<?php

namespace App\Console\Commands\DB;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Reload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Перезагружает ДБ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('down', ['--secret' => env('APP_KEY', 'secret')]);

        $this->call('db:backup');
        $this->call('db:backup', ['--data' => true]);

        try {
            $this->call('migrate:fresh', ['--seed' => true, '--force' => true]);
            $this->info('Запуск восстановленя последней копии');
            $this->call('db:restore', ['--last' => true, '--data' => true]);
        } catch (\Throwable $th) {
            $this->error('Во время выполнения произошла ошибка, запускается откат');
            $this->call('db:restore', ['--last' => true]);
        }

        $this->call('up');
    }
}
