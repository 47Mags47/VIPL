<?php

use App\Models\Glossary\EventStatus;
use App\Models\Glossary\Payment;
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
        Schema::create('glossary__event_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('payment__events', function (Blueprint $table) {
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
        Schema::dropIfExists('payment__events');
        Schema::dropIfExists('glossary__event_statuses');
    }
};
