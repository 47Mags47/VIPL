<?php

namespace App\Classes;

use App\Models\Glossary\Bank;
use App\Models\Glossary\Event;
use App\Models\Main\Raports\Payment\BankFile;
use App\Models\Main\Raports\Payment\Total;
use App\Models\Sys\FileStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Exporter
{
    public Bank $bank;
    public Total $raport;
    public Collection $recipients;
    public Event $event;
    public string $npp;

    protected BankFile $db;
    protected string $fileName;
    protected string $fileUUID;

    public function __construct(Bank $bank, Total $raport, Collection $recipients)
    {
        $this->bank = $bank;
        $this->raport = $raport;
        $this->event = $raport->event;
        $this->recipients = $recipients;

        $this->npp = str_pad((string) $raport->event->npp, 5, '0', STR_PAD_LEFT);

        $this->fileUUID = Str::random(40);
        $this->fileName = $this->fileUUID;

        $this->db = $raport->bankFiles()->create([
            'disk'          => 'bank-files',
            'path'          => '',
            'name'          => $this->fileUUID,
            'original_name' => $this->fileName,

            'status_id'     => FileStatus::byCode('create')->id,
            'raport_id'     => $this->raport->id,
            'bank_id'       => $this->bank->id,
        ]);
    }

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
        $this->db->update(['original_name' => $fileName]);
    }

    abstract public function generate();

    public function getFile()
    {
        return fopen($this->db->getFullPath(), 'w');
    }
}
