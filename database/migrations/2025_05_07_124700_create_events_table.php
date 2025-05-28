<?php

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
        Schema::create('payment__events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('payment_id')->constrained(Payment::getTableName());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__events');
    }
};
