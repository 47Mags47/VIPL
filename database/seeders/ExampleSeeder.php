<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(Dev\Glossary\BankSeeder::class);
        $this->call(Dev\Glossary\DivisionSeeder::class);
        $this->call(Dev\Glossary\SourceSeeder::class);
        $this->call(Dev\Glossary\LawSeeder::class);
        $this->call(Dev\Glossary\PaymentSeeder::class);

        $this->call(Dev\ConfigurateSeeder::class);

        $this->call(Dev\Main\UserSeeder::class);

        $this->call(Dev\Payment\EventSeeder::class);
        $this->call(Dev\Payment\PackageSeeder::class);
        $this->call(Dev\Payment\FileSeeder::class);
        $this->call(Dev\Payment\RecipientSeeder::class);
    }
}
