<?php

namespace App\Jobs\Payment\BankFiles;

use App\Models\Main\Raports\Payment\Total;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Total $raport) {}

    public function handle(): void
    {
        foreach ($this->raport->event->filesGroupByBank() as $bank_id => ['bank' => $bank, 'files' => $files]) {
            $recipients = collect($files)
                ->map(function ($file) {
                    return $file->recipients;
                })
                ->collapse()
                ->sortBy(function ($recipient) {
                    return $recipient->last_name . $recipient->first_name . $recipient->middle_name;
                })
                ->values();

            $exporter_string = "App\\Exporters\\" . ucfirst($bank->exporter->code) . 'BankExporter';
            if (class_exists($exporter_string))
                new $exporter_string($bank, $this->raport, $recipients)->generate();
            else {
                Log::error('Попытка вызвать несуществующий экспортер', [
                    'bank' => $bank->number_code,
                    'exporter' => $bank->exporter->id,
                    'event' => $this->raport->event->id,
                    'call' => $exporter_string,
                    'caller' => __FILE__
                ]);
            }
        }
    }
}
