<?php

namespace Database\Seeders\Glossary;

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
        Division::create([
            'code' => 'root',
            'name' => env('DIVISION_NAME', 'root')
        ]);
    }
}
