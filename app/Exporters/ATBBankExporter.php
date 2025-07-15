<?php

namespace App\Exporters;

use App\Classes\ExcelExporter;
use Illuminate\Support\Facades\Storage;

class ATBBankExporter extends ExcelExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('sp22_' . substr($this->npp, 3, 2) . '.xls');
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(Storage::disk('templates')->path('payment_raport_atb.xls'));
    }

    public function save(): ATBBankExporter
    {
        $this->spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'Реестр на перечисление социальных выплат за ' . $this->event->date->translatedFormat('F Y') . 'г.')
            ->setCellValue('B2', 'на счета физических лиц от ('. sys_config('division.name') .')')
            ->setCellValue('A3', $this->event->date->format('d.m.Y'));

        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                $i + 1,
                (string) $recipient->last_name . ' ' . (string) $recipient->first_name . ' ' . (string) $recipient->middle_name,
                (string) $recipient->account,
                (string) number_format($recipient->summ, 2, '.', ''),
            ];
        });
        $this->spreadsheet->getSheetByName('Реестр')->fromArray($data_array->toArray(), NULL, 'A5');

        $highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
        $this->spreadsheet->getActiveSheet()->setCellValue([1, $highestRow + 1], 'ИТОГО:');
        $this->spreadsheet->getActiveSheet()->setCellValue([4, $highestRow + 1], number_format($this->recipients->sum('summ'), 2, '.', ''));

        foreach (range('A', 'D') as $col) {
            $this->spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $this->writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($this->spreadsheet);
        $this->writer->save($this->getFullPath());

        return $this;
    }
}
