<?php

namespace Database\Seeders\Dev\Payment;

use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Package::all() as $package) {
            File::factory(5)->create(['package_id' => $package->id]);
        }
    }
}
