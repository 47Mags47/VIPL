<?php

namespace App\Exporters;

use App\Classes\ExcelExporter;

class SovkomBankExporter extends ExcelExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('Список_' . $this->event->date->format('d_Ym') . '_' . substr($this->npp, 3, 2) . '.xlsx');
    }

    public function writeHeader()
    {
        $this->spreadsheet
            ->getActiveSheet()
            ->fromArray([
                (string) 'ФАМИЛИЯ',
                (string) 'ИМЯ',
                (string) 'ОТЧЕСТВО',
                (string) 'СЧЕТ',
                (string) 'СУММА',
                (string) 'КОД_Д',
            ]);
    }

    public function writeBody()
    {
        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                (string) $recipient->last_name,
                (string) $recipient->first_name,
                (string) $recipient->middle_name,
                (string) $recipient->account,
                (string) number_format($recipient->summ, 2, '.', ''),
                (string) '47'
            ];
        });
        $this->spreadsheet->getActiveSheet()->fromArray($data_array->toArray(), NULL, 'A2');
    }

    public function save(): SovkomBankExporter
    {
        $this->writeHeader();
        $this->writeBody();

        foreach (range('A', 'F') as $col) {
            $this->spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $this->writer->save($this->getFullPath());

        return $this;
    }
}
