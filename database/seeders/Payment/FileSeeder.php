<?php

namespace Database\Seeders\Payment;

use App\Models\Glossary\FileStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FileStatus::create(['code' => 'uploaded',   'name' => 'Загружен']);
        FileStatus::create(['code' => 'reading',    'name' => 'Чтение']);
        FileStatus::create(['code' => 'read',       'name' => 'Прочитан']);
        FileStatus::create(['code' => 'loading',    'name' => 'Загружается в БД']);
        FileStatus::create(['code' => 'load',       'name' => 'Загружаен в БД']);
        FileStatus::create(['code' => 'has-errors', 'name' => 'содержит ошибки']);
    }
}
