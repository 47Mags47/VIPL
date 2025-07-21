<?php

use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
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

            $table->foreignId('status_id')->constrained(FileStatus::getTableName());
            $table->foreignId('raport_id')->constrained(Raport::getTableName())->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained(Bank::getTableName())->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
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
