<?php

namespace Database\Factories\Payment;

use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $disk = 'uploads';
        $name = 'example.csv';
        $path = 'uploads';

        return [
            'disk' => $disk,
            'path' => $path,
            'name' => $name,
            'origin_name' => 'example.csv',

            'errors' => [],
            'package_id' => Package::all()->random()->id,
            'bank_id' => Bank::all()->random()->id,
            'status_id' => FileStatus::all()->random()->id,
        ];
    }
}
