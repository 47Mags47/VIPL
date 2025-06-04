<?php

namespace App\Exporters;

use App\Classes\ExcelExporter;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// use PhpOffice\PhpSpreadsheet\Reader\Xls;

class AlfaBankExporter extends ExcelExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $division_inn = $this->bank->contract->division->INN;
        $division_name = $this->bank->contract->division->name;
        $payment_code = $this->event->payment->code;

        $this->setFileName($division_inn . '_' . str_replace(' ', '', $division_name) . '_' . $payment_code . '_' . substr($this->raport_npp, 2, 3) . '.xls');
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(Storage::disk('local')->path('templates/payment_raport_alfabank.xls'));
    }

    public function save(): AlfaBankExporter
    {
        $this->spreadsheet
            ->getSheetByName('Реестр')
            ->setCellValue('D6', 'Реестр №' . $this->event->date->format('m/d'))
            ->setCellValue('B11', 'ИНН ' . $this->bank->contract->division->INN . ' БИК ' . $this->bank->contract->division->BIK . ' к/с № ' . $this->bank->contract->division->account)
            ->setCellValue('B12', 'за ' . $this->event->date->translatedFormat('F Y') . ' г.')
            ->setCellValue('B13', 'согласно платежному поручению № ' . $this->raport_npp . ' от ' . $this->event->date->translatedFormat('«d» F Y ') . ' года')
            ->setCellValue('E15', $this->event->date->translatedFormat('«d» F Y год'))
            ->setCellValue('B20', 'Итого: ' . $this->recipients->count() . ' количество перечислений ')
            ->setCellValue('B21', $this->recipients->count() . ' количество Работников')
            ->setCellValue('B22', number_format($this->recipients->sum('summ'), 2, '.', '') . ' общая сумма перечислений');

        $this->spreadsheet
            ->getSheetByName('Info')
            ->setCellValue('B1', $this->bank->contract->division->name)
            ->setCellValue('B2', $this->bank->contract->division->INN)
            ->setCellValue('B3', $this->bank->contract->division->account)
            ->setCellValue('B6', $this->event->date->format('d.m.Y'))
            ->setCellValue('B7', '333')
            ->setCellValue('B8', 'RUR');

        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                mb_strtoupper((string) $recipient->last_name),
                mb_strtoupper((string) $recipient->first_name),
                mb_strtoupper((string) $recipient->middle_name),
                (string) $recipient->account,
                (string) number_format($recipient->summ, 2, '.', ''),
            ];
        });
        $this->spreadsheet->getSheetByName('Payments')->fromArray($data_array->toArray(), NULL, 'A2');

        $this->writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($this->spreadsheet);
        $this->writer->save($this->getFullPath());

        return $this;
    }
}
