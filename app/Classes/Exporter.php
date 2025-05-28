<?php

namespace App\Classes;

use App\Models\Glossary\Bank;
use App\Models\Main\Raport;
use App\Models\Main\User;
use App\Models\Payment\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class Exporter
{
    public Collection $recipients;
    public string $save_path = '';
    public string $file_name = 'tmp';
    public Raport|null $raport = null;
    public User|null $startBy = null;
    public string $raport_npp;

    public function __construct(public Bank $bank, public Event $event)
    {
        $raports_last_year = Raport::whereBetween('created_at', [now()->addYear(-1), now()])->get();
        $this->raport_npp = str_pad((string) $raports_last_year->count() + 1, 5, '0', STR_PAD_LEFT);
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

        if ($this->raport !== null)
            $this->raport->update([
                'disk' => $disk,
                'path' => $path,
                'name' => $fileName,
            ]);

        return $this;
    }

    public function delete(): bool
    {
        if ($this->raport !== null)
            $this->raport->delete();

        return Storage::disk('local')->delete($this->save_path . '/' . $this->file_name);
    }

    public function createDB(): Exporter
    {
        $this->raport = Raport::create([
            'disk' => 'local',
            'path' => $this->save_path,
            'name' => $this->file_name,
            'comment' => 'Отчет в банк ' . $this->bank->name,
            'start_by' => $this->startBy
        ]);

        return $this;
    }

    public abstract function save(): Exporter;
}
