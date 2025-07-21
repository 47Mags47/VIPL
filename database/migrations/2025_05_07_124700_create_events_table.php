<?php

use App\Models\Glossary\Payment;
use App\Models\Sys\Payment\EventStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sys__payment__event_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('main__payment__events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('npp');

            $table->foreignId('payment_id')->constrained(Payment::getTableName());
            $table->foreignId('status_id')->constrained(EventStatus::getTableName());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__payment_events');
        Schema::dropIfExists('sys__payment__event_statuses');
    }
};
