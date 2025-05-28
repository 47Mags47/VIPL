<?php

namespace Database\Seeders\Dev\Payment;

use App\Jobs\Payment\GenerateEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $job = new GenerateEvents();
        $job->handle();
    }
}
