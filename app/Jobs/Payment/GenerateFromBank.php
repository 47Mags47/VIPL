<?php

namespace App\Jobs\Payment;

use App\Events\SendAlertEvent;
use App\Models\Glossary\Bank;
use App\Models\Main\User;
use App\Models\Payment\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class GenerateFromBank implements ShouldQueue
{
    use Queueable;

    /**
     * Формирует отчетный документ для конкретного банка
     */
    public function __construct(public Event $event, public Bank $bank, public User $started_by, public Collection $recipients) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $exporter_string = "App\\Exporters\\" . ucfirst($this->bank->exporter->code) . 'BankExporter';

        if (class_exists($exporter_string)) {
            $exporter = new $exporter_string($this->bank, $this->event);
            $exporter
                ->addData($this->recipients)
                ->save()
                ->createDb()
                ->moveToDisk('bank-files', '' . $this->event->payment->code . '/' . $this->bank->number_code);
        } else {
            SendAlertEvent::dispatch($this->started_by, 'Попытка вызвать несуществующий экспортер', 'error');

            Log::error('Попытка вызвать несуществующий экспортер', [
                'bank' => $this->bank->number_code,
                'exporter' => $this->bank->exporter->id,
                'event' => $this->event->id,
                'call' => $exporter_string,
                'caller' => __FILE__
            ]);
        }
    }
}
