<?php

namespace Database\Factories\Payment;

use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = '001/test/001_02_sberbank_19032025_191.csv';

        return [
            'path' => $path,
            'hash' => Storage::disk('ftp')->checksum($path),
            'size' => Storage::disk('ftp')->size($path),
            'errors' => [],
            'package_id' => Package::all()->random()->id,
            'bank_id' => Bank::all()->random()->id,
            'status_id' => FileStatus::all()->random()->id,
        ];
    }
}
