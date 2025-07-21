<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(15)->create();
    }
}
