<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\Payment;
use App\Models\Payment\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create(['date' => now(), 'payment_id' => Payment::all()->random()->id]);
    }
}
