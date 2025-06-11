<?php

namespace App\Jobs\Payment;

use App\Events\SendAlertEvent;
use App\Models\Glossary\Bank;
use App\Models\Main\User;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class GenerateFromBanks implements ShouldQueue
{
    use Queueable;

    public $packages;
    public $files;

    /**
     * Генерирует выплатные ведомости для банков
     * @param Event $event - Выплата для начисления
     * @param User $user - Пользователи, запустивший операцию
     */
    public function __construct(public Event $event, public User $user) {}

    public function handle(): void
    {
        $this->packages = $this->event->packages;

        $this->files = $this->packages->map(function ($package) {
            return $package->files;
        })->collapse()->groupBy('bank_id');

        foreach ($this->files as $bank_id => $files) {
            $bank = Bank::whereKey($bank_id)->first();
            if ($bank == null)
                continue;

            $recipients = $files->map(function ($file) {
                return $file->recipients;
            })->collapse()->sortBy(function ($recipient) {
                return $recipient->last_name . $recipient->first_name . $recipient->middle_name;
            })->values();

            $job = new GenerateFromBank($this->event, $bank, $this->user, $recipients);
            $job->handle();
        }

        SendAlertEvent::dispatch($this->user, 'Отчет по выплате ' . $this->event->payment->name . ' на ' . $this->event->date->format('d.m.Y') . ' сформирован');
    }
}
