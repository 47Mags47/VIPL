<?php

namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

abstract class ExcelExporter extends Exporter
{
    public $spreadsheet;
    public $writer;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xls($this->spreadsheet);
    }
}
