<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Glossary\Bank;
use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Package::all() as $package) {
            foreach (Bank::all() as $bank) {
                File::factory()->create(['package_id' => $package->id, 'bank_id' => $bank->id]);
            }
        }
    }
}
