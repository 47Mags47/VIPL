<?php

use App\Models\Glossary\Law;
use App\Models\Glossary\PaymentPeriodicity;
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
        Schema::create('glossary__payment_periodicity', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('carbon');
        });

        Schema::create('glossary__payments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->string('krv');
            $table->string('kbk');

            $table->foreignId('law_id')->constrained(Law::getTableName());
            $table->foreignId('periodicity_id')->constrained(PaymentPeriodicity::getTableName());

            $table->timestamp('start_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glossary__payments');
        Schema::dropIfExists('glossary__payment_periodicity');
    }
};
