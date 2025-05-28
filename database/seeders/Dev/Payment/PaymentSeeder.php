<?php

namespace Database\Seeders\Dev\Payment;

use App\Models\Glossary\Payment;
use App\Models\Glossary\PaymentLaw;
use App\Models\Glossary\PaymentPeriodicity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 10) as $i) {
            Payment::create([
                'code' => str_pad("$i", 3, "0", STR_PAD_LEFT),
                'name' => 'Выплата № '. str_pad("$i", 3, "0", STR_PAD_LEFT),
                'krv' => 'Выплата № '. str_pad("$i", 3, "0", STR_PAD_LEFT),
                'kbk' => $faker->numerify('888 1003 0240###### ###'),
                'law_id' => PaymentLaw::all()->random()->id,
                'periodicity_id' => PaymentPeriodicity::all()->random()->id,
            ]);
        }
    }
}
