<?php

namespace Database\Seeders\Glossary;

use App\Models\Glossary\ValidatorColumn;
use App\Models\Glossary\ValidatorColumnType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValidatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ValidatorColumnType::create(['code' => 'string']);
        ValidatorColumnType::create(['code' => 'date']);
        ValidatorColumnType::create(['code' => 'integer']);
        ValidatorColumnType::create(['code' => 'float']);

        ValidatorColumn::create([
            'code' => 'np',
            'name' => 'Номер по порядку',
            'file_pos' => 1,
            'required' => false,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('integer')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'first_name',
            'name' => 'Фамилия',
            'file_pos' => 2,
            'required' => false,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'last_name',
            'name' => 'Имя',
            'file_pos' => 3,
            'required' => true,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'middle_name',
            'name' => 'Отчество',
            'file_pos' => 4,
            'required' => false,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'd_rojd',
            'name' => 'Дата рождения',
            'file_pos' => 5,
            'required' => true,
            'patterns' => [
                '##.##.####'
            ],
            'type_id' => ValidatorColumnType::byCode('date')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'snils',
            'name' => 'СНИЛС',
            'file_pos' => 6,
            'required' => true,
            'patterns' => [
                '###-###-### ##'
            ],
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'account',
            'name' => 'Счет',
            'file_pos' => 7,
            'required' => true,
            'patterns' => [
                '40817810############',
                '40820810############',
                '40823810############',
                '40914810############',
                '423##810############'
            ],
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'summ',
            'name' => 'Сумма',
            'file_pos' => 8,
            'required' => true,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('float')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'p_series',
            'name' => 'Папорт серия',
            'file_pos' => 9,
            'required' => true,
            'patterns' => [
                '####',
            ],
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'p_number',
            'name' => 'Папорт номер',
            'file_pos' => 10,
            'required' => true,
            'patterns' => [
                '######',
            ],
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'p_date',
            'name' => 'Папорт дата выдачи',
            'file_pos' => 11,
            'required' => true,
            'patterns' => [
                '##.##.####'
            ],
            'type_id' => ValidatorColumnType::byCode('date')->id,
        ]);

        ValidatorColumn::create([
            'code' => 'p_div',
            'name' => 'Папорт место выдачи',
            'file_pos' => 12,
            'required' => true,
            'patterns' => null,
            'type_id' => ValidatorColumnType::byCode('string')->id,
        ]);
    }
}
