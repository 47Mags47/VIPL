<?php

use App\Models\Glossary\PaymentLaw;
use App\Models\Glossary\PaymentPeriodicity;
use App\Models\Glossary\PaymentSource;
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
        Schema::create('glossary__payment_sources', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('glossary__payment_laws', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('name');

            $table->foreignId('source_id')->nullable()->constrained(PaymentSource::getTableName());

            $table->timestamps();
        });

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

            $table->foreignId('law_id')->constrained(PaymentLaw::getTableName());
            $table->foreignId('periodicity_id')->constrained(PaymentPeriodicity::getTableName());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glossary__payments');
        Schema::dropIfExists('glossary__payment_periodicity');
        Schema::dropIfExists('glossary__payment_laws');
        Schema::dropIfExists('glossary__payment_sources');
    }
};
