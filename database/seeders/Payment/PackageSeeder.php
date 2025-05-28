<?php

namespace Database\Seeders\Payment;

use App\Models\Glossary\PackageStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageStatus::create(['code' => 'created', 'name' => 'Новый']);
        PackageStatus::create(['code' => 'updated', 'name' => 'На изменении']);
        PackageStatus::create(['code' => 'ready',   'name' => 'Завершен']);
    }
}
