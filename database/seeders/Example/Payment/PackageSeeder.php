<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\Payment;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::createEventsToPeriod(now()->startOfMonth(), now()->endOfMonth());

        Package::factory(10)->create(['event_id' => Event::first()->id]);
    }
}
