<?php

namespace App\Classes;

use App\Models\Glossary\Bank;
use App\Models\Payment\BankFile;
use App\Models\Payment\Event;
use App\Models\Payment\Raport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class Exporter
{
    public Collection $recipients;
    public string $save_path = '';
    public string $file_name = 'tmp';
    public BankFile|null $file = null;
    public string $npp;

    public function __construct(public Bank $bank, public Event $event)
    {
        $npp = BankFile::where('bank_id', $this->bank->id)->whereBetween('created_at', [now()->addYear(-1), now()])->count() + 1;
        $this->npp = str_pad((string) $npp, 5, '0', STR_PAD_LEFT);
    }

    public function setFileName(string $name): Exporter
    {
        $this->file_name = $name;

        return $this;
    }

    public function setFilePath(string $path): Exporter
    {
        $this->save_path = $path;

        return $this;
    }

    public function getFullPath(string|null $disk = 'local'): string
    {
        return Storage::disk($disk)->path($this->save_path . '/' . $this->file_name);
    }

    public function addData(Collection $recipients): Exporter
    {
        $this->recipients = $recipients;

        return $this;
    }

    public function moveToDisk(string $disk, string|null $path = null, string|null $fileName = null): Exporter
    {
        $path = $path ?? $this->save_path;
        $fileName = $fileName ?? $this->file_name;
        $content = Storage::disk('local')->get($this->save_path . '/' . $this->file_name);

        Storage::disk($disk)->put($path . '/' . $fileName, $content);

        Storage::disk('local')->delete($this->save_path . '/' . $this->file_name);

        if ($this->file !== null)
            $this->file->update([
                'disk' => $disk,
                'path' => $path,
                'name' => $fileName,
            ]);

        return $this;
    }

    public function delete(): bool
    {
        if ($this->file !== null)
            $this->file->delete();
        // DEV вопросики
        return Storage::disk('local')->delete($this->save_path . '/' . $this->file_name);
    }

    public function createDB(Raport $raport): Exporter
    {
        $this->file = BankFile::create([
            'disk' => 'local',
            'path' => $this->save_path,
            'name' => $this->file_name,
            'original_name' => 'Отчет в банк ' . $this->bank->name,

            'raport_id' => $raport->id,
            'event_id' => $this->event->id,
            'bank_id' => $this->bank->id,
        ]);

        return $this;
    }

    public abstract function save(): Exporter;
}
