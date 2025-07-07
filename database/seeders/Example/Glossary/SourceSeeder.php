<?php

namespace Database\Seeders\Example\Glossary;

use App\Models\Glossary\Source;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Source::create(['code' => '010', 'name' => 'Региональные бюджет']);
        Source::create(['code' => '100', 'name' => 'Федеральный бюджет']);
    }
}
