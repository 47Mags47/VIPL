<?php

namespace Database\Factories\Payment;

use App\Models\Payment\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Recipient>
 */
class RecipientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_id' => File::all()->random()->id,

            'first_name'=> $this->faker->firstName('men'),
            'last_name'=> $this->faker->lastName('men'),
            'middle_name'=> $this->faker->firstName('men') . 'ич',
            'd_rojd' => $this->faker->date(),
            'snils' => $this->faker->numerify('###-###-### ##'),

            'account' => $this->faker->numerify('####################'),
            'summ' => $this->faker->randomFloat(2),

            'p_series' => $this->faker->numerify('####'),
            'p_number' => $this->faker->numerify('######'),
            'p_date' => $this->faker->date(),
            'p_div' => $this->faker->company(),

        ];
    }
}
