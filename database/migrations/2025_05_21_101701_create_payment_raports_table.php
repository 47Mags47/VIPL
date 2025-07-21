<?php

use App\Models\Glossary\Bank;
use App\Models\Glossary\Event;
use App\Models\Main\Raports\Payment\Total;
use App\Models\Main\User;
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
        Schema::create('main__raports__payment__totals', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('name');
            $table->string('original_name');

            $table->foreignId('status_id')->constrained(FileStatus::getTableName());
            $table->foreignId('event_id')->constrained(Event::getTableName())->cascadeOnDelete();
            $table->foreignId('start_by')->constrained(User::getTableName());

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('main__raports__payment__bank_files', function (Blueprint $table) {
            $table->id();

            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('name');
            $table->string('original_name');

            $table->foreignId('status_id')->constrained(FileStatus::getTableName());
            $table->foreignId('raport_id')->constrained(Total::getTableName())->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained(Bank::getTableName())->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('main__raports__payment__bank_files_archives', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('name');
            $table->string('original_name');

            $table->foreignId('raport_id')->constrained(Total::getTableName())->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__raports__payment_raport');
    }
};
