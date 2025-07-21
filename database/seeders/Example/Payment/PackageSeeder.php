<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\Event;
use App\Models\Main\Payment\Package;
use App\Models\Sys\Payment\PackageStatus;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::factory(2)->create([
            'event_id' => Event::orderBy('date')->get()->first()->id,
            'status_id' => PackageStatus::byCode('ready')->id,
        ]);
    }
}
