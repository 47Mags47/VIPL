<?php

namespace App\Jobs\Payment;

use App\Models\Glossary\Bank;
use App\Models\Glossary\Division;
use App\Models\Payment\Raport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GeneratePaymentRaport implements ShouldQueue
{
    use Queueable;

    private string $file_name;
    private Spreadsheet $spreadsheet;
    private Xlsx $writer;

    /**
     * Create a new job instance.
     */
    public function __construct(public Raport $raport)
    {
        $this->file_name = 'Отчет по ' . $this->raport->event->payment->code . ' выплате на ' . $this->raport->event->date->format('d.m.Y') . '.xls';
        $this->spreadsheet = new Spreadsheet();
        $this->writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->spreadsheet);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /* START */
        $files_groupBy_bank = $this->raport->packages->map(function ($package) {
            return $package->files;
        })->collapse()->groupBy('bank_id');
        /* END */

        // Заполняем шапку документа
        $this->spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'Выплатная информация ГКУ ЦСВИ за ' . $this->raport->event->date->translatedFormat('d F Y г.')) // DEV вынести наименование организации
            ->setCellValue('A2', 'Отчет 1: Вид выплаты, кредит. орг.')
            ->setCellValue('A3', $this->raport->event->payment->code . ' - ' . $this->raport->event->payment->name);

        $this->spreadsheet->getActiveSheet()->mergeCells('A1:D1');
        $this->spreadsheet->getActiveSheet()->mergeCells('A2:D2');
        $this->spreadsheet->getActiveSheet()->mergeCells('A3:D3');
        $this->spreadsheet->getActiveSheet()->getStyle('A1:D3')->getFont()->setBold(true);

        // Заполняем данные банка
        $row_iterator = 4;
        $total_count = 0;
        $total_summ = 0;
        foreach ($files_groupBy_bank as $bank_id => $files) {
            $current_row = $row_iterator;
            $bank = Bank::whereKey($bank_id)->first();

            // Заполняем информацию о банке
            $this->spreadsheet->getActiveSheet()
                ->setCellValue('A' . $current_row, $bank->number_code . ' - ' . $bank->name);
            $this->spreadsheet->getActiveSheet()->getStyle('A' . $current_row)->getFont()->setBold(true);

            // Заполняем шапку банка
            $current_row++;
            $this->spreadsheet->getActiveSheet()
                ->setCellValue('A' . $current_row, 'Территория')
                ->setCellValue('C' . $current_row, 'Количество')
                ->setCellValue('D' . $current_row, 'Сумма');

            // Заполняем данные банка по подразделениям
            $bank_count = 0;
            $bank_summ = 0;

            foreach ($files as $file) {
                $current_row++;
                $division = Division::whereKey($file->package->division_id)->first();

                $bank_count += $file->recipients->count();
                $bank_summ += $file->recipients->sum('summ');

                $total_count += $bank_count;
                $total_summ += $bank_summ;

                $this->spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $current_row, $division->code . ' - ' . $division->name)
                    ->setCellValue('C' . $current_row, $file->recipients->count())
                    ->setCellValue('D' . $current_row, number_format($file->recipients->sum('summ'), 2, '.', ''));

                $this->spreadsheet->getActiveSheet()->getRowDimension($current_row)->setOutlineLevel(1);
                $this->spreadsheet->getActiveSheet()->getStyle('D' . $current_row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
            }

            // Добавляем сводную информацию по банку
            $current_row++;
            $this->spreadsheet->getActiveSheet()
                ->setCellValue('A' . $current_row, 'Итого по ' . $bank->number_code . ' - ' . $bank->name)
                ->setCellValue('C' . $current_row, $bank_count)
                ->setCellValue('D' . $current_row, $bank_summ);

            // Устанавливаем стили для сводной информации
            $this->spreadsheet->getActiveSheet()->getStyle('A' . $current_row)->getFont()->setBold(true);
            $this->spreadsheet->getActiveSheet()->getStyle('D' . $current_row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

            // Переходим к следующему банку
            $row_iterator = $current_row + 1;
        }

        // Заполняем сводную информацию по выплате
        $current_row++;
        $this->spreadsheet->getActiveSheet()
            ->setCellValue('A' . $current_row, 'Итого по ' . $this->raport->event->payment->code . ' - ' . $this->raport->event->payment->name)
            ->setCellValue('C' . $current_row, $total_count)
            ->setCellValue('D' . $current_row, $total_summ);

        $this->spreadsheet->getActiveSheet()->getStyle('A' . $current_row)->getFont()->setBold(true);
        $this->spreadsheet->getActiveSheet()->getStyle('D' . $current_row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

        // Устанавливаем автоматическую ширину ячеек
        foreach (range('A', 'D') as $columnID) {
            $this->spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // Устанавливаем границы ячеек
        $this->spreadsheet->getActiveSheet()
            ->getStyle('A1:D' . $current_row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        // сохраняем файл
        $this->writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->spreadsheet);
        $this->writer->save(Storage::disk('raports')->path('test.xlsx'));
    }
}
