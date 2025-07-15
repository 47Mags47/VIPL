<?php

namespace Database\Seeders\Example;

use App\Models\Sys\Config;
use Illuminate\Database\Seeder;

class ConfigurateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        Config::byCode('division.name')->update(['value' => $faker->company()]);
        Config::byCode('division.INN')->update(['value' => $faker->numerify('##########')]);
        Config::byCode('division.account')->update(['value' => $faker->numerify('####################')]);
        Config::byCode('division.BIK')->update(['value' => $faker->numerify('#########')]);
        Config::byCode('division.phone')->update(['value' => $faker->phoneNumber()]);
        Config::byCode('division.FIO')->update(['value' => 'Петров П.П.']);
    }
}
