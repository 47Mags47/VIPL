<?php

namespace App\Imports\Payment;

use App\Models\Glossary\ValidatorColumn;
use App\Models\Payment\File;
use App\Models\Payment\Recipient;
use Illuminate\Support\Facades\Log;
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
        $recipient = Recipient::firstOrNew(
            [
                'file_id' => $this->file->id,
                'snils' => $row[5],
                'account' => $row[6],
            ]
        );

        $recipient->file_id       = $this->file->id;
        $recipient->last_name     = $row[1] !== null ? mb_strtoupper($row[1]) : null;
        $recipient->first_name    = mb_strtoupper($row[2]);
        $recipient->middle_name   = $row[3] !== null ? mb_strtoupper($row[3]) : null;
        $recipient->d_rojd        = $row[4] ?? null;
        $recipient->summ          = $recipient->summ + ($row[7] ?? 0);
        $recipient->p_series      = $row[8] ?? null;
        $recipient->p_number      = $row[9] ?? null;
        $recipient->p_date        = $row[10] ?? null;
        $recipient->p_div         = $row[11] ?? null;

        $recipient->save();
        return $recipient;
    }

    public function rules(): array
    {
        return ValidatorColumn::orderBy('file_pos')->get()->map(function ($column) {
            return [
                (string) $column->file_pos - 1 =>
                function ($attribute, $value, $onFailure) use ($column) {
                    if ($column->required and ($value === null or $value === ''))
                        $onFailure('Поле "' . $column->name . '" не может быть пустым');

                    if (count($column->patterns) !== 0) {
                        $valid_flag = false;

                        foreach ($column->patterns as $pattern) {
                            $regular = str_replace(['#', '.', '@', 'а', 'А', 'z', 'Z', '*',], ['[0-9]', '.', '[a-zA-Zа-яА-Я]', '[а-я]', '[А-Я]', '[a-z]', '[A-Z]', '*',], $pattern);
                            if (preg_match("/" . $regular . "/", $value))
                                $valid_flag = true;
                        }

                        if ($valid_flag === false)
                            $onFailure('Поле "' . $column->name . '" ("' . $value . '") не соответсвует шаблону ' . implode(', ', $column->patterns));
                    }
                }
            ];
        })->toArray();
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'CP866',
            'delimiter' => ";"
        ];
    }
}
