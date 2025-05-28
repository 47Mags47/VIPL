<?php

namespace App\Classes;

use XMLWriter;

abstract class XMLExporter extends Exporter
{
    public $writer;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->writer = new XMLWriter();
    }
}
