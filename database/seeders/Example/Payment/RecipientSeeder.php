<?php

namespace Database\Seeders\Example\Payment;

use App\Models\Payment\File;
use App\Models\Payment\Recipient;
use Illuminate\Database\Seeder;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (File::all() as $file) {
            Recipient::factory(5)->create([
                'summ' => 10,
                'file_id' => $file->id
            ]);
        }
    }
}
