<?php

use App\Models\Glossary\Bank;
use App\Models\Main\Payment\Package;
use App\Models\Sys\FileStatus;
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
        Schema::create('main__payment__files', function (Blueprint $table) {
            $table->id();

            $table->string('disk')->default('local');
            $table->text('path');
            $table->string('name');
            $table->string('origin_name');

            $table->json('errors');
            $table->json('error_context')->nullable();

            $table->uuid('package_id')->constrained(Package::getTableName());
            $table->foreignId('bank_id')->constrained(Bank::getTableName());
            $table->foreignId('status_id')->constrained(FileStatus::getTableName());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__payment__files');
    }
};
