<?php

use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
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
        Schema::create('glossary__bank_exporters', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();

            $table->timestamps();
        });

        Schema::create('glossary__contracts', function (Blueprint $table) {
            $table->id();

            $table->string('number')->nullable();
            $table->date('signed_at')->nullable();

            $table->timestamps();
        });

        Schema::create('glossary__banks', function (Blueprint $table) {
            $table->id();
            $table->string('number_code')->unique();
            $table->string('code')->unique();
            $table->string('name')->unique();

            $table->foreignId('exporter_id')->constrained(BankExporter::getTableName());
            $table->foreignId('contract_id')->nullable()->constrained(Contract::getTableName());

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glossary__banks');
        Schema::dropIfExists('glossary__contracts');
        Schema::dropIfExists('glossary__bank_exporters');
    }
};
