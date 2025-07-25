<?php

namespace Database\Seeders\Example\Glossary;

use App\Models\Glossary\Law;
use App\Models\Glossary\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        Payment::create([
            'code' => '001',
            'name' => 'Выплата № 001',
            'kbk' => $faker->numerify('88810030240#########'),
            'law_id' => Law::all()->random()->id,
        ]);
    }
}
