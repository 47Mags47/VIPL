<?php

namespace App\Jobs\Payment;

use App\Models\Glossary\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateEvents implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        Payment::generate();
    }
}
