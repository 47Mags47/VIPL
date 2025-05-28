<?php

namespace Database\Seeders\Dev\Payment;

use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::factory(10)->create(['event_id' => Event::first()->id]);
    }
}
