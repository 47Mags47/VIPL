<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Sys\ConfigSeeder::class);

        $this->call(Glossary\BankSeeder::class);
        $this->call(Glossary\DivisionSeeder::class);
        $this->call(Glossary\ValidatorSeeder::class);
        $this->call(Glossary\FileStatusSeeder::class);

        $this->call(Main\PermissionSeeder::class);
        $this->call(Main\UserSeeder::class);
        $this->call(Main\AlertSeeder::class);

        $this->call(Payment\PackageSeeder::class);


        if(env('APP_ENV') === 'local')
            $this->call(ExampleSeeder::class);
    }
}
