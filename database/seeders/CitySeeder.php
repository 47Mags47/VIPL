<?php

namespace Database\Seeders;

use App\Models\Glossary_City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Glossary_City::create(['id' => 1, 'name' => 'Анжеро-Судженск']);
        Glossary_City::create(['id' => 2, 'name' => 'Белово']);
        Glossary_City::create(['id' => 3, 'name' => 'Берёзовский']);
        Glossary_City::create(['id' => 4, 'name' => 'Гурьевск']);
        Glossary_City::create(['id' => 5, 'name' => 'Ижморский']);
        Glossary_City::create(['id' => 6, 'name' => 'Калтан']);
        Glossary_City::create(['id' => 7, 'name' => 'Кемерово']);
        Glossary_City::create(['id' => 9, 'name' => 'Киселёвск']);
        Glossary_City::create(['id' => 10, 'name' => 'Крапивинский']);
        Glossary_City::create(['id' => 12, 'name' => 'Ленинск-Кузнецкий']);
        Glossary_City::create(['id' => 13, 'name' => 'Мариинск']);
        Glossary_City::create(['id' => 14, 'name' => 'Междуреченск']);
        Glossary_City::create(['id' => 15, 'name' => 'Мыски']);
        Glossary_City::create(['id' => 16, 'name' => 'Новокузнецк']);
        Glossary_City::create(['id' => 17, 'name' => 'Осинники']);
        Glossary_City::create(['id' => 18, 'name' => 'Полысаево']);
        Glossary_City::create(['id' => 19, 'name' => 'Прокопьевск']);
        Glossary_City::create(['id' => 20, 'name' => 'Промышленовский']);
        Glossary_City::create(['id' => 21, 'name' => 'Тайга']);
        Glossary_City::create(['id' => 22, 'name' => 'Таштагол']);
        Glossary_City::create(['id' => 23, 'name' => 'Тисуль']);
        Glossary_City::create(['id' => 24, 'name' => 'Топки']);
        Glossary_City::create(['id' => 25, 'name' => 'Тяжин']);
        Glossary_City::create(['id' => 26, 'name' => 'Чебула']);
        Glossary_City::create(['id' => 27, 'name' => 'Юрга']);
        Glossary_City::create(['id' => 28, 'name' => 'Яя']);
        Glossary_City::create(['id' => 29, 'name' => 'Яшкино']);
    }
}
