<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(Example\ConfigurateSeeder::class);

        $this->call(Example\Glossary\BankSeeder::class);
        $this->call(Example\Glossary\DivisionSeeder::class);
        $this->call(Example\Glossary\SourceSeeder::class);
        $this->call(Example\Glossary\LawSeeder::class);
        $this->call(Example\Glossary\PaymentSeeder::class);

        $this->call(Example\Main\UserSeeder::class);

        $this->call(Example\Payment\EventSeeder::class);
        $this->call(Example\Payment\PackageSeeder::class);
        $this->call(Example\Payment\FileSeeder::class);
        $this->call(Example\Payment\RecipientSeeder::class);
    }
}
