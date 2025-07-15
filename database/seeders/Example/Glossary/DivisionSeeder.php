<?php

namespace Database\Seeders\Example\Glossary;

use App\Models\Glossary\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            Division::create([
                'code' => str_pad("$i", 3, "0", STR_PAD_LEFT),
                'name' => 'Город '. str_pad("$i", 3, "0", STR_PAD_LEFT)
            ]);
        }
    }
}
