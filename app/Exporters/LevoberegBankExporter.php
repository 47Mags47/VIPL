<?php

namespace App\Exporters;

use App\Classes\CsvExporter;

class LevoberegBankExporter extends CsvExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->setFileName('000' . $this->npp . '.csv');
    }

    public function writeHeader()
    {
        $this->spreadsheet
            ->getActiveSheet()
            ->fromArray([
                (string) '00',
                (string) '0000',
                (string) $this->event->date->format('d.m.Y'),
                (string) $this->recipients->count(),
                (string) number_format($this->recipients->sum('summ'), 2, '.', ''),
            ]);
    }

    public function writeBody()
    {
        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                (string) $i + 1,
                null,
                (string) $recipient->last_name,
                (string) $recipient->first_name,
                (string) $recipient->middle_name,
                (string) $recipient->account,
                (string) number_format($recipient->summ, 2, '.', ''),
            ];
        });

        $this->spreadsheet->getActiveSheet()->fromArray($data_array->toArray(), null, 'A2');
    }

    public function generate(): LevoberegBankExporter
    {
        $this->writeHeader();
        $this->writeBody();

        $this->writer
            ->setEnclosure('')
            ->setOutputEncoding('CP866');

        $this->save();

        return $this;
    }
}
