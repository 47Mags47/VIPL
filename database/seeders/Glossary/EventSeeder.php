<?php

namespace Database\Seeders\Glossary;

use App\Models\Sys\Payment\EventStatus;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventStatus::create(['code' => 'active', 'name' => 'Активна']);
        EventStatus::create(['code' => 'disabled', 'name' => 'Отключена']);
    }
}
