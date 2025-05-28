<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;

class Exporter extends GeneratorCommand
{
    protected $name = 'make:exporter';

    protected $description = 'Create a new Exporter class';

    protected $type = 'Exporter';

    protected function getStub()
    {
        return  app_path().'/Console/Stubs/Exporter.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Exporters';
    }

    protected function getOptions()
    {
        return [];
    }
}
