<?php

use App\Models\Glossary\Bank;
use App\Models\Payment\Event;
use App\Models\Payment\Raport;
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
        Schema::create('payment__bank_files', function (Blueprint $table) {
            $table->id();

            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('name');
            $table->string('original_name');

            $table->foreignId('raport_id')->constrained(Raport::getTableName());
            $table->foreignId('event_id')->constrained(Event::getTableName());
            $table->foreignId('bank_id')->constrained(Bank::getTableName());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__bank_files');
    }
};
