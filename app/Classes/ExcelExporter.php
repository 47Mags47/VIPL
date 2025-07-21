<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

abstract class ExcelExporter extends Exporter
{
    public Spreadsheet $spreadsheet;
    public Xls $writer;

    protected string|null $templatePath;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xls($this->spreadsheet);
    }

    public function setTemplate(string $path)
    {
        $this->templatePath = $path;
        $this->spreadsheet = IOFactory::load(Storage::disk('templates')->path($path));
    }

    public function save()
    {
        $this->writer->save($this->db->getFullPath());
    }
}
