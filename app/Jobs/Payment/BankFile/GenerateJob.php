<?php

namespace App\Jobs\Payment\BankFile;

use App\Models\Payment\Raport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateJob implements ShouldQueue
{
    use Queueable;


    public function __construct(public Raport $raport) {}


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
            if (class_exists($exporter_string)) {
                $exporter = new $exporter_string($bank, $this->raport->event);
                $exporter
                    ->addData($recipients)
                    ->save()
                    ->createDb($this->raport)
                    ->moveToDisk('bank-files', '' . $this->raport->event->payment->code . '/' . $bank->number_code);
            } else {
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
