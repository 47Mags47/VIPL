<?php

namespace App\Imports\Payment;

use App\Models\Importer\ValidateColumn;
use App\Models\Payment\File;
use App\Models\Payment\Recipient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;

class RecipientImport implements ToModel, WithValidation, WithCustomCsvSettings
{

    public function __construct(public File $file) {}

    /**
     * @param array $row
     *
     * @return \App\Models\Payment\Recipient|null
     */
    public function model(array $row)
    {
        // Если запись уже существует, увеличить сумму
        $find_model = Recipient::where('file_id', $this->file->id)->where('snils', $row[5])->where('account', $row[6])->first();
        if ($find_model) {
            $find_model->update([
                'summ' => $find_model->summ + $row[7]
            ]);
            return;
        }

        return new Recipient([
            'file_id'       => $this->file->id,

            'last_name'     => $row[1] !== null ? mb_strtoupper($row[1]) : null,
            'first_name'    => mb_strtoupper($row[2]),
            'middle_name'   => $row[3] !== null ? mb_strtoupper($row[3]) : null,
            'd_rojd'        => $row[4] ?? null,
            'snils'         => $row[5] ?? null,

            'account'       => $row[6] ?? null,
            'summ'          => $row[7] ?? null,

            'p_series'      => $row[8] ?? null,
            'p_number'      => $row[9] ?? null,
            'p_date'        => $row[10] ?? null,
            'p_div'         => $row[11] ?? null,
        ]);
    }

    public function rules(): array
    {
        $columns = ValidateColumn::orderBy('file_pos')->get();

        $test = $columns->map(function ($column) {
            return [(string) $column->file_pos => function ($attribute, $value, $onFailure) use ($column) {
                if ($column->required and $value === null) $onFailure('Поле ' . $column->name . ' не может быть пустым');

                if ($column->patterns !== null) {
                    $valid_flag = false;
                    foreach ($column->patterns as $pattern) {
                        $regular = str_replace([
                            '#',                    // - число
                            '.',                    // - любой символ
                            '@',                    // - любая буква
                            'а',                    // - русская строчная буква
                            'А',                    // - русская заглавная буква
                            'z',                    // - английская строчная буква
                            'Z',                    // - английская заглавная буква
                            '*',                    // - Любое количество символов
                        ], [
                            '[0-9]',                // - число
                            '.',                    // - любой символ
                            '[a-zA-Zа-яА-Я]',       // - любая буква
                            '[а-я]',                // - русская строчная буква
                            '[А-Я]',                // - русская заглавная буква
                            '[a-z]',                // - английская строчная буква
                            '[A-Z]',                // - английская заглавная буква
                            '*',                    // - Любое количество символов
                        ], $pattern);

                        if (preg_match("/" . $regular . "/", $value))
                            $valid_flag = true;
                    }

                    if (!$valid_flag){
                        dd([$column, $value]);
                    }
                }
            }];
        })->toArray();

        return $test;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'CP866',
            'delimiter' => ";"
        ];
    }
}
