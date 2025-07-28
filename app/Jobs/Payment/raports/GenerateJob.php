<?php

namespace App\Jobs\Payment\raports;

use App\Events\Payment\Raport\ChangePercentEvent;
use App\Jobs\Payment\BankFiles\GenerateJob as BankFileGenerateJob;
use App\Models\Glossary\Event;
use App\Models\Main\Raports\Payment\Total;
use App\Models\Main\User;
use App\Models\Sys\FileStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateJob implements ShouldQueue
{
    use Queueable;

    private const FILE_DISK = 'raports';
    private const FILE_PATH = 'payment';

    private string $file_name;
    private string $file_origin_name;
    private string $file_full_path;
    private string $event_name;
    private Spreadsheet $spreadsheet;
    private Xlsx $writer;
    private Total $raport;

    public function __construct(public Event $event, private User $user)
    {
        $this->raport = $this->event->raports()->create([
            'disk' => self::FILE_DISK,
            'path' => self::FILE_PATH,
            'name' => Str::random(40) . '.xlsx',
            'original_name' => 'Отчет по '
                . $this->event->payment->code
                . ' выплате на '
                . $this->event->date->format('d.m.Y')
                . ' № '
                . Total::where('event_id', $this->event->id)->count() + 1
                . '.xls',
            'event_id' => $this->event->id,
            'start_by' => $this->user->id,
            'status_id' => FileStatus::byCode('create')->id,
        ]);
    }

    public function handle(): void
    {
        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xlsx($this->spreadsheet);

        try {
            // Заполняем шапку документа
            $this->spreadsheet->getActiveSheet()
                ->setTitle('Свод по банкам')
                ->setCellValue('A1', 'Выплатная информация ' . sys_config('division.name') . ' за ' . $this->event->date->translatedFormat('d F Y г.'))
                ->setCellValue('A2', 'Отчет 1: Вид выплаты, кредит. орг.')
                ->setCellValue('A3', $this->event->payment->code . ' - ' . $this->event->payment->name);

            $this->spreadsheet->getActiveSheet()->mergeCells('A1:D1');
            $this->spreadsheet->getActiveSheet()->mergeCells('A2:D2');
            $this->spreadsheet->getActiveSheet()->mergeCells('A3:D3');
            $this->spreadsheet->getActiveSheet()->getStyle('A1:D3')->getFont()->setBold(true);

            // Заполняем данные банка
            $row_iterator = 4;
            $total_count = 0;
            $total_summ = 0;

            foreach ($this->event->filesGroupByBank() as $bank_id => ['bank' => $bank, 'files' => $files]) {
                $current_row = $row_iterator;

                // Заполняем информацию о банке
                $this->spreadsheet->getActiveSheet()->setCellValue('A' . $current_row, $bank->number_code . ' - ' . $bank->name);
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
                    $division = $file->package->division;

                    $bank_count += $file->recipients->count();
                    $bank_summ += $file->recipients->sum('summ');

                    $total_count += $file->recipients->count();
                    $total_summ += $file->recipients->sum('summ');

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
                ->setCellValue('A' . $current_row, 'Итого по ' . $this->event->payment->code . ' - ' . $this->event->payment->name)
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

            ChangePercentEvent::dispatch($this->raport, 50);

            // Переходим на второй лист
            $divisionSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($this->spreadsheet, 'Свод по территориям');
            $this->spreadsheet->addSheet($divisionSheet, 1);

            $this->spreadsheet
                ->setActiveSheetIndex(1)
                ->setCellValue('A1', 'Выплатная информация ' . sys_config('division.name') . ' за ' . $this->event->date->translatedFormat('d F Y г.'))
                ->setCellValue('A2', 'Отчет 1: Вид выплаты, кредит. орг.')
                ->setCellValue('A3', $this->event->payment->code . ' - ' . $this->event->payment->name);

            $this->spreadsheet->getActiveSheet()->mergeCells('A1:D1');
            $this->spreadsheet->getActiveSheet()->mergeCells('A2:D2');
            $this->spreadsheet->getActiveSheet()->mergeCells('A3:D3');
            $this->spreadsheet->getActiveSheet()->getStyle('A1:D3')->getFont()->setBold(true);

            // Заполняем данные банка
            $row_iterator = 4;
            $total_count = 0;
            $total_summ = 0;

            foreach ($this->event->filesGroupByDivision() as $division_id => ['division' => $division, 'banks' => $banks]) {
                $current_row = $row_iterator;

                // Заполняем информацию о территории
                $this->spreadsheet->getActiveSheet()->setCellValue('A' . $current_row, $division->code . ' - ' . $division->name);
                $this->spreadsheet->getActiveSheet()->getStyle('A' . $current_row)->getFont()->setBold(true);

                // Заполняем шапку банка
                $current_row++;
                $this->spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $current_row, 'Банк')
                    ->setCellValue('C' . $current_row, 'Количество')
                    ->setCellValue('D' . $current_row, 'Сумма');

                // Заполняем данные банка по подразделениям
                $division_count = 0;
                $division_summ = 0;

                foreach ($banks as $bank_id => ['bank' => $bank, 'files' => $files]) {
                    $bank_count = 0;
                    $bank_summ = 0;

                    foreach ($bank['files'] as $file) {
                        $bank_count += $file->recipients->count();
                        $bank_summ += $file->recipients->sum('summ');

                        $division_count += $file->recipients->count();
                        $division_summ += $file->recipients->sum('summ');

                        $total_count += $file->recipients->count();
                        $total_summ += $file->recipients->sum('summ');
                    }

                    $current_row++;
                    $this->spreadsheet->getActiveSheet()
                        ->setCellValue('A' . $current_row, $bank->number_code . ' - ' . $bank->name)
                        ->setCellValue('C' . $current_row, $bank_count)
                        ->setCellValue('D' . $current_row, number_format($bank_summ, 2, '.', ''));

                    $this->spreadsheet->getActiveSheet()->getRowDimension($current_row)->setOutlineLevel(1);
                    $this->spreadsheet->getActiveSheet()->getStyle('D' . $current_row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
                }

                // Добавляем сводную информацию по территории
                $current_row++;
                $this->spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $current_row, 'Итого по ' . $division->code . ' - ' . $division->name)
                    ->setCellValue('C' . $current_row, $division_count)
                    ->setCellValue('D' . $current_row, $division_summ);

                // Устанавливаем стили для сводной информации
                $this->spreadsheet->getActiveSheet()->getStyle('A' . $current_row)->getFont()->setBold(true);
                $this->spreadsheet->getActiveSheet()->getStyle('D' . $current_row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

                // Переходим к следующей территории
                $row_iterator = $current_row + 1;
            }

            // Заполняем сводную информацию по выплате
            $current_row++;
            $this->spreadsheet->getActiveSheet()
                ->setCellValue('A' . $current_row, 'Итого по ' . $this->event->payment->code . ' - ' . $this->event->payment->name)
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
            $this->writer->save($this->raport->getFullPath());

            // Запускаем создание фалойв в банк
            $generator = new BankFileGenerateJob($this->raport);
            $generator->handle();
        } catch (\Throwable $th) {
            $this->raport->setStatus('create error');
            Log::error($th);
            ChangePercentEvent::dispatch($this->raport, 100);
        }
    }
}
