<?php

namespace App\Exporters;

use App\Classes\CsvExporter;
use Illuminate\Support\Facades\Storage;

class KbbBankExporter extends CsvExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->setFileName('SZRG_KBB20_' . $this->event->date->format('dmY') . '_' . substr($this->npp, 0, 4) . '.csv');
    }

    public function save(): KbbBankExporter
    {
        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                (int) $i + 1,
                (string) implode(' ', [
                    (string) $recipient->last_name,
                    (string) $recipient->first_name,
                    (string) $recipient->middle_name,
                ]),
                (string) $recipient->d_rojd->format('d/m/Y'),
                (string) 8,
                (string) implode(' ', [
                    (string) substr($recipient->p_series, 0, 2),
                    (string) substr($recipient->p_series, 2, 2),
                    (string) $recipient->p_number,
                ]),
                (string) $recipient->p_date->format('d/m/Y'),
                (string) $recipient->p_div,
                (string) $recipient->kbk,
                (string) number_format($recipient->summ, 2, '.', ''),
            ];
        });

        $this->spreadsheet->getActiveSheet()->fromArray($data_array->toArray());

        $this->writer
            ->setEnclosure('')
            ->setDelimiter(';')
            ->setOutputEncoding('windows-1251')
            ->save($this->getFullPath());

        return $this;
    }
}
