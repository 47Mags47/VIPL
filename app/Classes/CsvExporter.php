<?php

namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

abstract class CsvExporter extends Exporter
{
    public Spreadsheet $spreadsheet;
    public Csv $writer;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Csv($this->spreadsheet);
    }
}
