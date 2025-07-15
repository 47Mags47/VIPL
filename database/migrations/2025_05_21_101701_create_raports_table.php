<?php

use App\Models\Glossary\FileStatus;
use App\Models\Main\User;
use App\Models\Payment\Event;
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
        Schema::create('payment__raports', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__raports');
    }
};
