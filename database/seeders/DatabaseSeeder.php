<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Glossary\BankSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Glossary\BankSeeder::class);

        $this->call(Importer\ValidatorSeeder::class);

        $this->call(Main\PermissionSeeder::class);
        $this->call(Main\UserSeeder::class);
        $this->call(Main\AlertSeeder::class);

        $this->call(Payment\PaymentSeeder::class);
        $this->call(Payment\PackageSeeder::class);
        $this->call(Payment\FileSeeder::class);

        if(env('APP_ENV') === 'local')
            $this->call(DevSeeder::class);
    }
}
