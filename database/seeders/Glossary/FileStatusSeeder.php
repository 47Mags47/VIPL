<?php

namespace Database\Seeders\Glossary;

use App\Models\Sys\FileStatus;
use Illuminate\Database\Seeder;

class FileStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FileStatus::create(['code' => 'create',         'name' => 'Создаётся',          'type' => 'job']);
        FileStatus::create(['code' => 'created',        'name' => 'Создан',             'type' => 'done']);
        FileStatus::create(['code' => 'edit',           'name' => 'Обновляется',        'type' => 'job']);
        FileStatus::create(['code' => 'edited',         'name' => 'Обновлен',           'type' => 'done']);
        FileStatus::create(['code' => 'reading',        'name' => 'Считывается',        'type' => 'job']);
        FileStatus::create(['code' => 'read',           'name' => 'Считан',             'type' => 'done']);
        FileStatus::create(['code' => 'loading',        'name' => 'Загружается',        'type' => 'job']);
        FileStatus::create(['code' => 'load',           'name' => 'Загружен',           'type' => 'done']);
        FileStatus::create(['code' => 'has-error',      'name' => 'Содержит ошибки',    'type' => 'error']);
        FileStatus::create(['code' => 'create error',   'name' => 'Ошибка создания',    'type' => 'error']);
        FileStatus::create(['code' => 'edit error',     'name' => 'Ошибка обновления',  'type' => 'error']);
        FileStatus::create(['code' => 'read error',     'name' => 'Ошибка чтения',      'type' => 'error']);
        FileStatus::create(['code' => 'load error',     'name' => 'Ошибка загрузки',    'type' => 'error']);
    }
}
