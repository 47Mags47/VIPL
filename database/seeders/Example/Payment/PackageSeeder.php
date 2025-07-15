<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\PackageStatus;
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
        Package::factory(2)->create([
            'event_id' => Event::first()->id,
            'status_id' => PackageStatus::byCode('ready')->id,
        ]);
    }
}
