<?php

namespace Database\Seeders\Dev;

use App\Models\Sys\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        Config::create(['code' => 'division', 'value' => [
            'name' => $faker->company(),
            'INN' => $faker->numerify('##########'),
            'account' => $faker->numerify('####################'),
            'BIK' => $faker->numerify('#########'),
        ]]);
    }
}
