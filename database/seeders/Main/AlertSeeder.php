<?php

namespace Database\Seeders\Main;

use App\Models\Main\AlertType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlertType::create(['code' => 'message', 'name' => 'Сообщение']);
        AlertType::create(['code' => 'error', 'name' => 'Ошибка']);
    }
}
