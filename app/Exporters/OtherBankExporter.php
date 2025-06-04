<?php

namespace App\Exporters;

use App\Classes\ExcelExporter;
use Illuminate\Support\Facades\Storage;

class OtherBankExporter extends ExcelExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('sp' . $this->bank->number_code . '_' . substr($this->raport_npp, 2, 3) . '.xls');
    }

    public function save(): OtherBankExporter
    {
        $headers = [
            'NPP',
            'FIO',
            'LSH',
            'SUMMA',
            'DTR',
            'PNM',
            'KBK'
        ];
        $this->spreadsheet->getActiveSheet()->fromArray($headers, NULL, 'A1');

        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                (int) $i + 1,
                (string) implode(' ', [
                    (string) $recipient->last_name,
                    (string) $recipient->first_name,
                    (string) $recipient->middle_name,
                ]),
                (string) $recipient->account,
                (float) $recipient->summ,
                (string) $recipient->d_rojd->format('d.m.Y'),
                (string) $recipient->pasp,
                (string) $recipient->kbk
            ];
        });

        $this->spreadsheet->getActiveSheet()->fromArray($data_array->toArray(), NULL, 'A2');

        $highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
        $this->spreadsheet->getActiveSheet()->setCellValue([3, $highestRow + 1], 'ИТОГО:');
        $this->spreadsheet->getActiveSheet()->setCellValue([4, $highestRow + 1], number_format($this->recipients->sum('summ'), 2, '.', ''));

        foreach (range('A', 'G') as $col) {
            $this->spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $this->writer->save($this->getFullPath());

        return $this;
    }
}
