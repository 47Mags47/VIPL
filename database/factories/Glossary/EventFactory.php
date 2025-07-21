<?php

namespace Database\Factories\Glossary;

use App\Models\Glossary\Payment;
use App\Models\Sys\Payment\EventStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => collect(now()->startOfMonth()->toPeriod(now()->endOfMonth())->toArray())->random(),
            'payment_id' => Payment::all()->random()->id,
            'status_id' => EventStatus::byCode('active')->id
        ];
    }
}
