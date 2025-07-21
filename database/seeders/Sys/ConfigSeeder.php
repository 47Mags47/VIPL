<?php

namespace Database\Seeders\Sys;

use App\Models\Sys\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::create(['code' => 'division.name',      'type' => 'string', 'value' => '', 'name' => 'Наименование организации']);
        Config::create(['code' => 'division.INN',       'type' => 'string', 'value' => '', 'name' => 'ИНН организации']);
        Config::create(['code' => 'division.account',   'type' => 'string', 'value' => '', 'name' => 'Счет организации']);
        Config::create(['code' => 'division.BIK',       'type' => 'string', 'value' => '', 'name' => 'БИК организации']);
        Config::create(['code' => 'division.phone',     'type' => 'string', 'value' => '', 'name' => 'Телефон организации']);
        Config::create(['code' => 'division.FIO',       'type' => 'string', 'value' => '', 'name' => 'ФИО ответственного']);
    }
}
