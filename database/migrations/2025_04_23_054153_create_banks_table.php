<?php

use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
use App\Models\Glossary\ContractSide;
use App\Models\Glossary\ContractSideType;
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

        Schema::create('glossary__contract_side_type', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
        });

        Schema::create('glossary__contract_sides', function (Blueprint $table) {
            $table->id();

            $table->text('name')->nullable();
            $table->string('INN')->nullable();
            $table->string('account')->nullable();
            $table->string('BIK')->nullable();
            $table->text('comment')->nullable();

            $table->foreignId('type_id')->constrained(ContractSideType::getTableName());

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('glossary__contracts', function (Blueprint $table) {
            $table->id();

            $table->string('number');
            $table->date('signed_at');

            $table->foreignId('division_side_id')->constrained(ContractSide::getTableName());
            $table->foreignId('bank_side_id')->constrained(ContractSide::getTableName());

            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('glossary__bank_templates');
        Schema::dropIfExists('glossary__contract_sides');
        Schema::dropIfExists('glossary__contract_side_type');
        Schema::dropIfExists('glossary__bank_exporters');
    }
};
