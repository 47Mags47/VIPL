<?php

namespace App\Imports\Payment;

use App\Models\Payment\File;
use App\Models\Payment\Recipient;
use App\Models\Validate\Account;
use Illuminate\Support\Carbon;
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
        $find_model = Recipient::where('file_id', $this->file->id)->where('snils', $row[9])->where('account', $row[4])->first();
        if ($find_model) {
            $find_model->update([
                'summ' => $find_model->summ + $row[5]
            ]);
            return;
        }

        // dd($row[15]);

        return new Recipient([
            ### Текущая выгрузка // DEV смена выгрузки
            ##################################################
            'file_id'       => $this->file->id,

            'last_name'     => $row[1] ?? null,
            'first_name'    => $row[2],
            'middle_name'   => $row[3] ?? null,
            'd_rojd'        => $row[7],
            'snils'         => $row[9],

            'account'       => $row[4],
            'summ'          => $row[5],
            'kbk'           => $row[8],

            'p_series'      => '0000',
            'p_number'      => $row[6],
            'p_date'        => now(),
            'p_div'         => 'Абстрактная организация по выдаче паспорта',

            ### Под формат новой выгрузки // DEV смена выгрузки
            ##################################################
            /*
            'file_id'       => $this->file->id,

            'last_name'     => $row[1] ?? null,
            'first_name'    => $row[2] ?? null,
            'middle_name'   => $row[3] ?? null,
            'd_rojd'        => $row[4] ?? null,
            'snils'         => $row[5] ?? null,

            'account'       => $row[6] ?? null,
            'summ'          => $row[7] ?? null,
            'kbk'           => $row[8] ?? null,

            'p_series'      => $row[9] ?? null,
            'p_number'      => $row[10] ?? null,
            'p_date'        => $row[11] ?? null,
            'p_div'         => $row[12] ?? null,
*/
        ]);
    }

    public function rules(): array
    {
        return [
            ### Текущая выгрузка // DEV смена выгрузки
            ##################################################
            // last_name
            '1' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Фамилия не может быть пустым');
            },

            // first_name
            '2' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Имя не может быть пустым');
            },

            // middle_name
            '3' => function ($attribute, $value, $onFailure) {},

            // account
            '4' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан счет получателя');

                if (preg_match('/^"[0-9]{20}"$/', (string) $value)) $onFailure("Неверный формат счёта получателя");

                $valid_flag = false;
                foreach (Account::all() as $account) {
                    $pattern = '/^' . str_replace('*', '.', $account->rule) . '$/';
                    if (preg_match($pattern, (string) $value)) $valid_flag = true;
                }
                if ($valid_flag === false)
                    $onFailure("Недопустимый счёт получателя");
            },

            // summ
            '5' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указанна сумма');

                if (preg_match('/^[0-9]*\,[0-9]{2}$/', (float) $value)) $onFailure('Неверный формат суммы');

                if ((float) $value == 0) $onFailure('Сумма не может быть 0');

                if ((float) $value < 0) $onFailure('Сумма не может быть меньше 0');
            },

            // pasp
            '6' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан номер паспорта');

                if (preg_match('/^"[0-9]{6}"$/', (string) $value)) $onFailure("Неверный формат паспортных данных");
            },

            // d_rojd
            '7' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указана дата рождения');

                if (preg_match('/^"[0-9]{2}\.[0-9]{2}\.[0-9]{4}"$/', (string) $value)) $onFailure("Неверный формат даты рождения");

                try {
                    Carbon::parse($value);
                } catch (\Exception $e) {
                    $onFailure("Недопустимая дата рождения");
                }
            },

            // kbk
            '8' => function ($attribute, $value, $onFailure) {

                if ($value === null) $onFailure('Не указан КБК');

                if (preg_match('/^"[0-9]{20}"$/', (string) $value)) $onFailure("Неверный формат КБК");
            },

            // snils
            '9' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан СНИЛС');

                if (preg_match('/^"[0-9]{3}-[0-9]{3}-[0-9]{3} [0-9]{2}"$/', (string) $value)) $onFailure("Неверный формат СНИЛС");
            },

            ### Под формат новой выгрузки // DEV смена выгрузки
            ##################################################
            /*

            // last_name
            '1' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Поле "Фамилия" не может быть пустым');
            },

            // first_name
            '2' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Поле "Имя" не может быть пустым');
            },

            // middle_name
            '3' => function ($attribute, $value, $onFailure) {

            },

            // d_rojd
            '4' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указана дата рождения');

                if (preg_match('/^"[0-9]{2}\.[0-9]{2}\.[0-9]{4}"$/', (string) $value)) $onFailure("Неверный формат даты рождения");

                try {
                    Carbon::parse($value);
                } catch (\Exception $e) {
                    $onFailure("Недопустимая дата рождения");
                }
            },

            // snils
            '5' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан СНИЛС');

                if (preg_match('/^"[0-9]{3}-[0-9]{3}-[0-9]{3} [0-9]{2}"$/', (string) $value)) $onFailure("Неверный формат СНИЛС");
            },

            // account
            '6' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан счет получателя');

                if (preg_match('/^"[0-9]{20}"$/', (string) $value)) $onFailure("Неверный формат счёта получателя");

                $valid_flag = false;
                foreach (Account::all() as $account) {
                    $pattern = '/^' . str_replace('*', '.', $account->rule) . '$/';
                    if (preg_match($pattern, (string) $value)) $valid_flag = true;
                }
                if ($valid_flag === false)
                    $onFailure("Недопустимый счёт получателя");
            },

            // summ
            '7' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указанна сумма');

                if (preg_match('/^[0-9]*\,[0-9]{2}$/', (float) $value)) $onFailure('Неверный формат суммы');

                if ((float) $value == 0) $onFailure('Сумма не может быть 0');

                if ((float) $value < 0) $onFailure('Сумма не может быть меньше 0');
            },

            // kbk
            '8' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан КБК');

                if (preg_match('/^"[0-9]{20}"$/', (string) $value)) $onFailure("Неверный формат КБК");
            },

            // p_series
            '9' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указана серия паспорта');

                if (preg_match('/^"[0-9]{4}"$/', (string) $value)) $onFailure("Неверный формат паспортных данных (серия)");
            },

            // p_number
            '10' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан номер паспорта');

                if (preg_match('/^"[0-9]{6}"$/', (string) $value)) $onFailure("Неверный формат паспортных данных (номер)");
            },

            // p_date
            '11' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указана дата выдачи паспорта');
            },

            // p_div
            '12' => function ($attribute, $value, $onFailure) {
                if ($value === null) $onFailure('Не указан орган, выдавший паспорта');
            },

            */
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'CP866' // DEV смена выгрузки
            // 'input_encoding' => 'UTF-8' // DEV смена выгрузки
        ];
    }
}
