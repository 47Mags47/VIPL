<?php

namespace App\Exporters;

use App\Classes\ExcelExporter;
use Illuminate\Support\Facades\Storage;

class AlfaBankExporter extends ExcelExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $payment_code = $this->event->payment->code;

        preg_match_all("/[а-яА-Яa-zA-Z]/", sys_config('division.name'), $division_name);
        $division_name = mb_strtoupper(implode('', (array) $division_name[0]));

        $this->setFileName(sys_config('division.INN') . '_' . $division_name . '_' . $payment_code . '_' . substr($this->npp, 2, 3) . '.xls');
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(Storage::disk('templates')->path('payment_raport_alfabank.xls'));
    }

    public function save(): AlfaBankExporter
    {
        $this->spreadsheet
            ->getSheetByName('Реестр')
            ->setCellValue('D6', 'Реестр №' . $this->event->date->format('m/d'))
            ->setCellValue('B11', 'ИНН ' . sys_config('division.INN') . ' БИК ' . sys_config('division.BIK') . ' к/с № ' . sys_config('division.account'))
            ->setCellValue('B12', 'за ' . $this->event->date->translatedFormat('F Y') . ' г.')
            ->setCellValue('B13', 'согласно платежному поручению № ' . $this->npp . ' от ' . $this->event->date->translatedFormat('«d» F Y ') . ' года')
            ->setCellValue('E15', $this->event->date->translatedFormat('«d» F Y год'))
            ->setCellValue('B20', 'Итого: ' . $this->recipients->count() . ' количество перечислений ')
            ->setCellValue('B21', $this->recipients->count() . ' количество Работников')
            ->setCellValue('B22', number_format($this->recipients->sum('summ'), 2, '.', '') . ' общая сумма перечислений');

        $this->spreadsheet
            ->getSheetByName('Info')
            ->setCellValue('B1', sys_config('division.name'))
            ->setCellValue('B2', sys_config('division.INN'))
            ->setCellValue('B3', sys_config('division.account'))
            ->setCellValue('B6', $this->event->date->format('d.m.Y'))
            ->setCellValue('B7', '333')
            ->setCellValue('B8', 'RUR');

        $data_array = $this->recipients->map(function ($recipient, $i) {
            return [
                (string) $recipient->last_name,
                (string) $recipient->first_name,
                (string) $recipient->middle_name,
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
