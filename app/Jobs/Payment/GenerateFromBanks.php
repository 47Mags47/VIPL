<?php

namespace App\Jobs\Payment;

use App\Models\Glossary\Bank;
use App\Models\Main\User;
use App\Models\Payment\Event;
use App\Models\Payment\Raport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class GenerateFromBanks implements ShouldQueue
{
    use Queueable;

    /**
     * Генерирует выплатные ведомости для банков
     * @param Event $event - Выплата для начисления
     * @param User $user - Пользователи, запустивший операцию
     */
    public function __construct(public Event $event, public User $user) {}

    public function handle(): void
    {
        $raport = Raport::create([
            'disk' => 'raports',
            'path' => '',
            'name' => Str::random(40) . '.xlsx',
            'original_name' => 'Отчет по ' . $this->event->payment->code . ' - ' . $this->event->payment->name . '.xlsx',
            'event_id' => $this->event->id,
            'start_by' => $this->user->id
        ]);

        $files = $this->event->files->groupBy('bank_id');

        foreach ($files as $bank_id => $files) {
            $bank = Bank::whereKey($bank_id)->first();
            if ($bank == null)
                continue;

            $recipients = $files->map(function ($file) {
                return $file->recipients;
            })->collapse()->sortBy(function ($recipient) {
                return $recipient->last_name . $recipient->first_name . $recipient->middle_name;
            })->values();

            $job = new GenerateFromBank($this->event, $bank, $raport, $recipients);
            $job->handle();
        }

        $job = new GeneratePaymentRaport($raport);
        $job->handle();
    }
}
