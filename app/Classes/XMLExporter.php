<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use XMLWriter;

abstract class XMLExporter extends Exporter
{
    public $writer;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->writer = new XMLWriter();
    }

    public function save(){
        Storage::disk($this->db->disk)->put($this->db->getLocalPath(), $this->writer->outputMemory());
    }
}
