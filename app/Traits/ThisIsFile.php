<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ThisIsFile
{
    public function getLocalPath()
    {
        return $this->path !== ''
            ? $this->path . '/' . $this->name
            : $this->name;
    }

    public function getFullPath()
    {
        return Storage::disk($this->disk ?? 'local')->path($this->getLocalPath());
    }
}
