<?php

namespace Database\Factories\Main\Payment;

use App\Models\Glossary\Division;
use App\Models\Glossary\Event;
use App\Models\Sys\Payment\PackageStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'division_id' => Division::all()->random()->id,
            'event_id' => Event::all()->random()->id,
            'status_id' => PackageStatus::all()->random()->id,
        ];
    }
}
