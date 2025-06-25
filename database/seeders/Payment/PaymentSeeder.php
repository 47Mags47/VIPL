<?php

namespace Database\Seeders\Payment;

use App\Models\Glossary\PaymentPeriodicity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        PaymentPeriodicity::create(['code' => 'everyDay',         'name' => 'Каждый день',  'carbon' => '1 day']);
        PaymentPeriodicity::create(['code' => 'everyMonth',       'name' => 'Каждый месяц', 'carbon' => '1 month']);
        PaymentPeriodicity::create(['code' => 'everyYear',        'name' => 'Каждый год',   'carbon' => '1 year']);
    }
}
